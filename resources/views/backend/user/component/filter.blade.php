<div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0 mb-4">
  <!-- Phần chọn số bản ghi -->
  <div class="flex items-center">
    <select name="perpage" class="px-4 py-2 rounded-none border outline-none border-gray-300 ">
      @for($i = 10; $i <= 50; $i+=10)
        <option value="{{ $i}}">{{ $i }} bản ghi</option>
      @endfor
    </select>

    <!-- Phần chọn loại user -->
    <select name="user_catalogue_id" class="px-4 py-2 rounded-none border outline-none border-gray-300 ">
      <option value="0">User</option>
      <option value="1">Admin</option>
    </select>
  </div>

  <!-- Phần tìm kiếm -->
  <div class="flex items-center space-x-4">
    <div class="flex space-x-2">
      <input  
        type="text" 
        name="keyword" 
        value="" 
        placeholder="Nhập từ khoá bạn muốn tìm" 
        class="form-control rounded-lg border border-gray-300 px-2 py-1"
      >
      <button type="submit" name="search" value="search" class="btn btn-primary btn-sm !mb-0">
        Tìm kiếm
      </button>
    </div>

    <!-- Nút Thêm mới thành viên -->
    <a href="{{ route('user.create') }}" class="btn btn-danger flex items-center px-4 py-2 rounded-lg text-white !mb-0">
      <i class="fa fa-plus mr-2"></i> Thêm mới thành viên
    </a>
  </div>
</div>
