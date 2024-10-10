@include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['delete']['title']])
<form action="{{ route('permission.destroy', $permission->id) }}" method="post" class="box">
  @csrf
  @method('DELETE')
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-5">
              <div class="panel-head">
                  <div class="">
                      <p class="text-2xl text-red-500">
                        {{__('messages.permission.delete.confirmDelete') }} 
                        {{ $permission->name }}</p>
                        <p class="font-bold">
                            {{__('messages.generalWarning')}}
                        </p>
                  </div>
              </div>
          </div>
          <div class="col-lg-7">
              <div class="ibox">
                  <div class="ibox-content">
                      <div class="row mb15">
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.permission.permissionTitle') }}
                                    <span class="text-danger">(*)</span>
                                  </label>
                                  <input 
                                      type="text"
                                      name="name"
                                      value="{{ old('name', ($permission->name) ?? '' ) }}"
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                      readonly
                                  >
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.permission.permissionKeyword') }}
                                    <span class="text-danger">(*)</span>
                                  </label>
                                  <input 
                                      type="text"
                                      name="canonical"
                                      value="{{ old('canonical', ($permission->canonical) ?? '' ) }}"
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
          <button class="btn btn-danger" type="submit" name="send" value="send">
            {{__('messages.delete') }} 
        </button>
          <a href="{{ route('permission.index') }}" class="btn btn-primary">
            {{__('messages.cancel') }}
          </a>
      </div>
  </div>
</form>
