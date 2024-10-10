<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-8">
    <h2 class="mt-4">
      {{__('messages.permission.edit.title') }}
    </h2>
    <ol class="breadcrumb" style="margin-bottom: 10px;">
      <li class="mt-2">
        <a href="{{route('admin.dashboard')}}">
          {{__('messages.Dashboard') }}
        </a>
      </li>
      <li class="active">
        <strong>
          {{__('messages.permission.edit.title') }}
        </strong>
      </li>
    </ol>
  </div>
</div>
<form action="{{ route('user.catalogue.updatePermission') }}" method="post" class="box">
  @csrf
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-title">
                    <h5>{{__('messages.permission.Authorization') }}</h5>
                  </div>
                  <div class="ibox-content">
                      <table class="table table-striped table-bordered">
                          <tr>
                            <th>{{__('messages.permission.permissionTitle') }}</th>
                              {{-- <th>Key</th> --}}
                              @foreach(__('messages.userCatalogueRule') as $key => $val)
                                @if($key != 0)
                                  <th class="text-center">{{$val}}</th>
                                @endif
                              @endforeach
                          </tr>
                          @foreach($permissions as $permission)
                          <tr>
                              <td>
                                <p href="#" class="flex justify-between align-middle" >{{ $permission->name }} <span style="color:red;">({{ $permission->canonical }})</span> </p></td>
                              @foreach($userCatalogues as $userCatalogue)
                                @if($userCatalogue->id != 0)
                                  <td>
                                    <input 
                                    {{ (collect($userCatalogue->permissions)->contains('id', $permission->id)) ? 'checked' : '' }} 
                                    type="checkbox" 
                                    name="permission[{{$userCatalogue->id}}][]" 
                                    value="{{$permission->id}}" 
                                    class="form-control"
                                    >
                                  </td>
                                @endif
                              @endforeach
                          </tr>
                          @endforeach
                      </table>
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
