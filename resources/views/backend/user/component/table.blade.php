<table class="table table-striped table-bordered table-user">
  <thead>
  <tr>
      <th>
        <input type="checkbox" name="" id="checkAllUser">
      </th>
      <th>Thông tin thành viên</th>
      <th>Địa chỉ</th>
      <th>Tình trạng</th>
      <th>Thao tác</th>
  </tr>
  </thead>
  <tbody>
    {{-- @if (isset($users) && is_object($users)) --}}
      @for ($i = 0; $i < 20; $i++)
        <tr>
          <td>
            <input type="checkbox" name="" id="">
          </td>
          <td>
            <div class="user-item name">
              <strong>
                Họ tên:
              </strong>
              {{-- {{$user->name}} --}}
            </div>
            <div class="user-item email">
              <strong>
                Email:
              </strong>
              manhmanhmanh28@gmail.com
            </div>
            <div class="user-item phone">
              <strong>
                SDT:    
              </strong>
                0395792304
            </div>
          </td>
          <td>
            <div class="">
              <strong>
                Địa chỉ:
              </strong>
              An Xá, Quốc Tuấn, Nam Sách, Hải Dương
            </div>
            <div class="">
              <strong>
                Quận:
              </strong>
              Bắc Từ Liêm
            </div>
            <div class="">
              <strong>
                Thành phố:
              </strong>
              Hà Nội
            </div>
          </td>
          <td>
            <input type="checkbox" class="js-switch" checked="">
          </td>
          <td>
            <a href="">
              <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
            </a>
            <a href="">
              <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
            </a>
          </td>
      </tr>
      @endfor
    {{-- @endif --}}
  </tbody>
</table>
{{ $users->links('pagination::bootstrap-4') }}