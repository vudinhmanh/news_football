@include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['delete']['title']])
<form action="{{ route('user.catalogue.destroy', $userCatalogue->id) }}" method="post" delete="box">
  @csrf
  @method('DELETE')
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-5">
              <div class="panel-head">
                  <div class="">
                      <p class="text-2xl text-red-500">Bạn muốn xoá thành viên có tên là: {{ $userCatalogue->name }}</p>
                      <p class="font-semibold">Lưu ý: Những thông tin sau khi xoá không thể khôi phục </p>
                  </div>
              </div>
          </div>
          <div class="col-lg-7">
              <div class="ibox">
                  <div class="ibox-content">
                      <div class="row mb15">
                          <div class="col-lg-12">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">Họ tên <span class="text-danger">(*)</span></label>
                                  <input 
                                      type="text"
                                      name="name"
                                      value="{{ old('name', ($userCatalogue->name) ?? '' ) }}"
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
          <a href="{{ route('user.index') }}" class="btn btn-primary">
            Huỷ
          </a>

      </div>
  </div>
</form>