@if (strpos(url()->current(), 'edit') !== false)
    @include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['edit']['title']])
@else
    @include('backend.dashboard.component.breadcrump', ['title' => $config['seo']['create']['title']])
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = ($config['method'] == 'create' ? route('permission.store') : route('permission.update', $permission->id));
@endphp
<form action="{{ $url }}" method="post" class="box">
  @csrf 
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-5">
              <div class="panel-head">
                <div class="font-extrabold">{{__('messages.generalTitle') }}</div>
                  <div class="panel-description">
                    <p>{{__('messages.permission.commonLang') }}</p>
                    <p>
                        {{__('messages.generalRequiredField') }}
                        <span class="text-danger">(*)</span> 
                        {{__('messages.isRequired') }}
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
                                  >
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <hr>
      <div class="text-right mb15">
          <button class="btn btn-primary" type="submit" name="send" value="send">
            {{__('messages.save') }}
        </button>
      </div>
  </div>
</form>
