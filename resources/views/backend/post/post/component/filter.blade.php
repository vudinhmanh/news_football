<form action="{{ route('post.index') }}">
  <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0 mb-4">
    @php
      $perpage = request('perpage') ?: old('perpage');
    @endphp
    <!-- Phần chọn số bản ghi -->
    <div class="flex items-center">
      <select name="perpage" class="px-4 py-2 rounded-none border outline-none border-gray-300 ">
        @for($i = 10; $i <= 50; $i+=5)
          <option {{ ($perpage == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{ __('messages.perpage') }}</option>
        @endfor
      </select>
      @php
        $publish = request('publish') ?: old('publish'); 
        $postCatalogueId = request('post_catalogue_id') ?: old('post_catalogue_id'); 
      @endphp
      <select name="publish" class="px-4 py-2 rounded-none border outline-none border-gray-300 ">
        @foreach(__('messages.publish') as $key => $val)
        <option {{ ($publish == $key) ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
        @endforeach
      </select>
      <select name="post_catalogue_id" class="px-8 py-2 rounded-none border outline-none border-gray-300">
        @foreach($dropdown as $key => $val)
        <option {{ ($postCatalogueId == $key) ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
        @endforeach
      </select>
    </div>
    <!-- Phần tìm kiếm -->
    <div class="flex items-center space-x-4">
      <div class="flex space-x-2">
        <input  
          type="text" 
          name="keyword" 
          value="{{ request('keyword') ?: old('keyword') }}" 
          placeholder="{{ __('messages.searchInput') }}" 
          class="form-control rounded-lg border border-gray-300 px-6 py-1"
        >
        <button type="submit" name="search" value="search" class="btn btn-primary btn-sm !mb-0">
          {{ __('messages.search') }}
        </button>
      </div>
      <!-- Nút Thêm mới -->
      <a href="{{ route('post.create') }}" class="btn btn-danger flex items-center px-4 py-2 rounded-lg text-white !mb-0">
        <i class="fa fa-plus mr-2"></i> {{ __('messages.post.create.title') }}
      </a>
    </div>
  </div>
  
</form>