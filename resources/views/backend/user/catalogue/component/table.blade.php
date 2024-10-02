<table class="table table-striped table-bordered">
  <thead>
  <tr>
      <th>
          <input type="checkbox" value="" id="checkAll" class="input-checkbox">
      </th>
      <th>{{__('messages.userCatalogue.userCatalogueName') }}</th>
      <th>{{__('messages.userCatalogue.userCatalogueDes') }}</th>
      <th>{{__('messages.userCatalogue.userCatalogueQuantity') }}</th>
      <th class="text-center">{{__('messages.tableStatus') }}</th>
      <th class="text-center">{{__('messages.tableAction') }}</th>
  </tr>
  </thead>
  <tbody>
      @if(isset($userCatalogues) && is_object($userCatalogues))
          @foreach($userCatalogues as $userCatalogue)
          <tr>
              <td>
                  <input type="checkbox" value="{{ $userCatalogue->id }}" class="input-checkbox checkBoxItem">
              </td>
              <td>
                  {{ $userCatalogue->name }}
              </td>
              <td>
                {{ $userCatalogue->description }}
            </td>
            <td>
                {{ $userCatalogue->users_count }}
            </td>
              <td class="text-center js-switch-{{ $userCatalogue->id }}"> 
                  <input type="checkbox" value="{{ $userCatalogue->publish }}" class="js-switch status" data-field="publish" 
                  data-model="UserCatalogue"  
                    {{ ($userCatalogue->publish == 2) ? 'checked' : ''}}
                    data-modelId="{{ $userCatalogue->id }}"
                  />
              </td>
              <td class="text-center"> 
                  <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              </td>
          </tr>
          @endforeach
      @endif
  </tbody>
</table>
{{  $userCatalogues->links('backend.pagination.paginate') }}
