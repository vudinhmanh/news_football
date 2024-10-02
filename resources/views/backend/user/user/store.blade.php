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
    $url = ($config['method'] == 'create' ? route('user.store') : route('user.update', $user->id));
@endphp
<form action="{{ $url }}" method="post" class="box">
  @csrf 
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-5">
              <div class="panel-head">
                  <div class="font-extrabold">{{__('messages.generalTitle') }}</div>
                  <div class="panel-description">
                      <p>{{__('messages.user.commonInfor') }}</p>
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
                                    {{__('messages.user.userEmail') }} 
                                    <span class="text-danger">(*)</span>
                                    </label>
                                  <input 
                                      type="text"
                                      name="email"
                                      value="{{ old('email', ($user->email) ?? '' ) }}"
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                  >
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.userName') }}  
                                    <span class="text-danger">(*)</span>
                                </label>
                                  <input 
                                      type="text"
                                      name="name"
                                      value="{{ old('name', ($user->name) ?? '' ) }}"
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                  >
                              </div>
                          </div>
                      </div>
                      @php
                        $userCatalogue = [
                            __('messages.userCatalogueRule.0'),
                            __('messages.userCatalogueRule.1'),
                            __('messages.userCatalogueRule.2'),
                        ];       
                      @endphp
                      <div class="row mb15">
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">                                    
                                    {{__('messages.user.userCatalogue') }}  
                                    <span class="text-danger">(*)</span>
                                  </label>
                                  <select name="user_catalogue_id" class="form-control setupSelect2">
                                      @foreach($userCatalogue as $key => $item)
                                      <option {{ 
                                          $key == old('user_catalogue_id', (isset($user->user_catalogue_id)) ? $user->user_catalogue_id : '') ? 'selected' : '' 
                                          }}  value="{{ $key }}">{{ $item }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">                                    
                                    {{__('messages.user.dateOfBirth') }}  
                                    <span class="text-danger">(*)</span>
                                </label>
                                  <input 
                                      type="date"
                                      name="birthday"
                                      value="{{ old('birthday', (isset($user->birthday)) ? date('Y-m-d', strtotime($user->birthday)) : '') }}"
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                  >
                              </div>
                          </div>
                      </div>
                      @if($config['method'] == 'create')
                      <div class="row mb15">
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.password') }}  
                                    <span class="text-danger">(*)</span>
                                  </label>
                                  <input 
                                      type="password"
                                      name="password"
                                      value=""
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                  >
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.confirmPassword') }}  
                                    <span class="text-danger">(*)</span>
                                  </label>
                                  <input 
                                      type="password"
                                      name="re_password"
                                      value=""
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                  >
                              </div>
                          </div>
                      </div>
                      @endif
                      <div class="row mb-[15px]">
                          <div class="col-lg-12">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.avatar') }}  
                                  </label>
                                  <input 
                                      type="text"
                                      name="image"
                                      value="{{ old('image', ($user->image) ?? '') }}"
                                      class="form-control upload-image"
                                      placeholder=""
                                      autocomplete="off"
                                      data-upload="Images"
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
      <div class="row">
          <div class="col-lg-5">
              <div class="panel-head">
                  <div class="font-extrabold">
                    {{__('messages.user.contactInfor') }} 
                </div>
                  <div class="panel-description">
                    {{__('messages.user.fillContactInfor') }} 
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
                                    {{__('messages.user.city') }} 
                                </label>
                                  <select name="province_id" class="form-control setupSelect2 province location" data-target="districts">
                                      <option value="0">{{__('messages.user.chooseCity') }}</option>
                                      @if(isset($provinces))
                                          @foreach($provinces as $province)
                                          <option value="{{ $province->code }}">
                                            {{ $province->name }}
                                          </option>
                                          @endforeach
                                      @endif
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.district') }} 
                                  </label>
                                  <select name="district_id" class="form-control districts setupSelect2 location" data-target="wards">
                                      <option value="0">
                                        {{__('messages.user.chooseDistrict') }} 
                                      </option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row mb15">
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.ward') }} 
                                </label>
                                  <select name="ward_id" class="form-control setupSelect2 wards">
                                      <option value="0">
                                        {{__('messages.user.chooseWard') }} 
                                      </option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.address') }}
                                </label>
                                  <input 
                                      type="text"
                                      name="address"
                                      value="{{ old('addresss', ($user->address) ?? '') }}"
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                  >
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.user.userPhone') }}
                                </label>
                                  <input 
                                      type="text"
                                      name="phone"
                                      value="{{ old('phone', ($user->phone) ?? '') }}"
                                      class="form-control"
                                      placeholder=""
                                      autocomplete="off"
                                  >
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-row">
                                  <label for="" class="control-label text-left">
                                    {{__('messages.Note') }}
                                </label>
                                  <input 
                                      type="text"
                                      name="description"
                                      value="{{ old('description', ($user->description) ?? '') }}"
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
      <div class="text-right mb15">
          <button class="btn btn-primary" type="submit" name="send" value="send">
            {{__('messages.save') }}
        </button>
      </div>
  </div>
</form>
<script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : old('province_id') }}'
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : old('ward_id') }}'
</script>