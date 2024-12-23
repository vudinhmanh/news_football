<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Nestedsetbie
{
    // Khởi tạo các thuộc tính cần thiết cho Nested Set
    function __construct($params = NULL)
    {
        $this->params = $params;       // Tham số truyền vào (chứa thông tin về bảng, khóa ngoại, ngôn ngữ, v.v.)
        $this->checked = NULL;          // Mảng lưu trạng thái kiểm tra các nút đã duyệt
        $this->data = NULL;             // Mảng dữ liệu chứa cây phân cấp
        $this->count = 0;               // Bộ đếm dùng để gán giá trị `lft` và `rgt`
        $this->count_level = 0;         // Mức độ của nút hiện tại trong cây (depth)
        $this->lft = NULL;              // Mảng lưu giá trị `lft` (trái) của các nút
        $this->rgt = NULL;              // Mảng lưu giá trị `rgt` (phải) của các nút
        $this->level = NULL;            // Mảng lưu cấp độ (level) của các nút
    }

    // Lấy dữ liệu từ cơ sở dữ liệu
    public function Get()
    {
        // Nếu không có khóa ngoại, mặc định sử dụng 'post_catalogue_id'
        $foreignkey = (isset($this->params['foreignkey'])) ? $this->params['foreignkey'] : 'post_catalogue_id';

        // Tách phần tên bảng từ tham số 'table'
        $moduleExtract = explode('_', $this->params['table']);

        // Truy vấn lấy dữ liệu từ cơ sở dữ liệu
        $result = DB::table($this->params['table'] . ' as tb1')
            ->select('tb1.id', 'tb2.name', 'tb1.parentid', 'tb1.lft', 'tb1.rgt', 'tb1.level', 'tb1.order')
            // Thực hiện JOIN với bảng ngôn ngữ liên quan để lấy tên
            ->join($moduleExtract[0] . '_catalogue_language as tb2', 'tb1.id', '=', 'tb2.' . $foreignkey)
            // Lọc theo ngôn ngữ được chỉ định trong tham số 'language_id'
            ->where('tb2.language_id', '=', $this->params['language_id'])
            // Loại bỏ các bản ghi đã bị xóa (deleted_at là null)
            ->whereNull('tb1.deleted_at')
            // Sắp xếp theo giá trị `lft` để đảm bảo thứ tự cây phân cấp
            ->orderBy('tb1.lft', 'asc')
            // Lấy kết quả về dưới dạng mảng
            ->get()->toArray();

        // Gán kết quả truy vấn vào biến dữ liệu
        $this->data = $result;
    }

    // Chuyển đổi dữ liệu thành một mảng quan hệ giữa các nút (parent-child)
    public function Set()
    {
        if (isset($this->data) && is_array($this->data)) {
            $arr = NULL;
            // Duyệt qua từng phần tử dữ liệu
            foreach ($this->data as $key => $val) {
                // Tạo mối quan hệ giữa các nút parent và child
                $arr[$val->id][$val->parentid] = 1;
                $arr[$val->parentid][$val->id] = 1;
            }
            return $arr;
        }
    }

    // Đệ quy xác định các giá trị `lft`, `rgt` và `level` của các nút trong cây
    public function Recursive($start = 0, $arr = NULL)
    {
        // Gán giá trị `lft` cho nút hiện tại và tăng bộ đếm
        $this->lft[$start] = ++$this->count;
        // Gán giá trị `level` cho nút hiện tại
        $this->level[$start] = $this->count_level;

        if (isset($arr) && is_array($arr)) {
            // Duyệt qua các nút con của nút hiện tại
            foreach ($arr as $key => $val) {
                // Kiểm tra xem có mối quan hệ cha-con giữa `start` và `key` hay không
                if ((isset($arr[$start][$key]) || isset($arr[$key][$start])) && (!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key]))) {
                    // Tăng cấp độ cho nút con
                    $this->count_level++;
                    // Đánh dấu đã duyệt mối quan hệ
                    $this->checked[$start][$key] = 1;
                    $this->checked[$key][$start] = 1;
                    // Đệ quy để duyệt các nút con
                    $this->recursive($key, $arr);
                    // Giảm cấp độ sau khi duyệt xong nút con
                    $this->count_level--;
                }
            }
        }

        // Gán giá trị `rgt` cho nút hiện tại và tăng bộ đếm
        $this->rgt[$start] = ++$this->count;
    }

    // Cập nhật các giá trị `lft`, `rgt`, và `level` vào cơ sở dữ liệu
    public function Action()
    {
        if (isset($this->level) && is_array($this->level) && isset($this->lft) && is_array($this->lft) && isset($this->rgt) && is_array($this->rgt)) {

            $data = NULL;
            // Duyệt qua các cấp độ để tạo mảng dữ liệu cần cập nhật
            foreach ($this->level as $key => $val) {
                // Bỏ qua nút có id là 0 (root)
                if ($key == 0)
                    continue;
                $data[] = array(
                    'id' => $key,               // ID của nút
                    'level' => $val,            // Cấp độ của nút
                    'lft' => $this->lft[$key],  // Giá trị `lft` của nút
                    'rgt' => $this->rgt[$key],  // Giá trị `rgt` của nút
                    'user_id' => Auth::id(),    // ID người dùng hiện tại
                );
            }

            // Nếu có dữ liệu cần cập nhật, thực hiện cập nhật vào cơ sở dữ liệu
            if (isset($data) && is_array($data) && count($data)) {
                DB::table($this->params['table'])->upsert($data, 'id', ['level', 'lft', 'rgt']);
            }
        }
    }

    // Lấy dữ liệu cây phân cấp và chuyển đổi thành dạng dropdown
    public function Dropdown($param = NULL)
    {
        $this->get();  // Gọi hàm Get() để lấy dữ liệu
        if (isset($this->data) && is_array($this->data)) {
            $temp = NULL;
            // Nếu có tham số 'text', gán nó làm giá trị của mục root (nút gốc)
            $temp[0] = (isset($param['text']) && !empty($param['text'])) ? $param['text'] : '[Root]';

            // Duyệt qua các dữ liệu đã lấy được và tạo chuỗi thụt lề để hiển thị trong dropdown
            foreach ($this->data as $key => $val) {
                $temp[$val->id] = str_repeat('|-----', (($val->level > 0) ? ($val->level - 1) : 0)) . $val->name;
            }
            return $temp;
        }
    }
}
