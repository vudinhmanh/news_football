@include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['delete']['title']])
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('post.destroy', $post->id) }}" method="post" class="box">
  @csrf
  @method('DELETE')
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-5">
              <div class="panel-head">
                  <div class="">
                      <p class="text-2xl text-red-500">Bạn muốn xoá bài viết có tiêu đề: {{ $post->name }}</p>
                      <p class="font-semibold">Lưu ý: Những thông tin sau khi xoá không thể khôi phục </p>
                  </div>
              </div>
          </div>
          <div class="col-lg-7">
              <div class="ibox">
                  <div class="ibox-content">
                      <div class="row mb15">
                          <div class="col-lg-5">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">Tiêu đề <span class="text-danger">(*)</span></label>
                                  <input 
                                      type="text"
                                      name="name"
                                      value="{{ old('name', ($post->name) ?? '' ) }}"
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                      readonly
                                  >
                              </div>
                          </div>
                          <div class="col-lg-7">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">Đường dẫn <span class="text-danger">(*)</span></label>
                                  <input 
                                      type="text"
                                      name="canonical"
                                      value="{{ old('canonical', isset($post->canonical) ? config('app.url').$post->canonical.config('app.general.suffix') : '') }}"

                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                      readonly
                                  >
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <hr>
      <div class="text-center items-center">
          <button class="btn btn-danger" type="submit" name="send" value="send">Xoá</button>
          <a href="{{ route('post.index') }}" class="btn btn-primary">
            Huỷ
          </a>

      </div>
  </div>
</form>
