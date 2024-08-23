<table class="table table-striped table-bordered">
  <thead>
  <tr>
      <th>
          <input type="checkbox" value="" id="checkAll" class="input-checkbox">
      </th>
      <th>Ảnh</th>
      <th>Tên ngôn ngữ</th>
      <th>Từ khoá</th>
      <th class="text-center">Tình Trạng</th>
      <th class="text-center">Thao tác</th>
  </tr> 
  </thead>
  <tbody>
      @if(isset($postCatalogues) && is_object($postCatalogues))
          @foreach($postCatalogues as $postCatalogue)
          <tr>
              <td>
                  <input type="checkbox" value="{{ $postCatalogue->id }}" class="input-checkbox checkBoxItem">
              </td>
              <td class="max-w-[50px]">
                <span class="image object-cover">
                    <img src="{{ $postCatalogue->image }}" alt="">
                </span>
            </td>
              <td>
                  {{ $postCatalogue->name }}
              </td>
              <td>
                  {{ $postCatalogue->canonical }}
              </td>
              <td class="text-center js-switch-{{ $postCatalogue->id }}"> 
                  <input type="checkbox" value="{{ $postCatalogue->publish }}" class="js-switch status" data-field="publish" 
                  data-model="Postcatalogue"  
                    {{ ($postCatalogue->publish == 1) ? 'checked' : ''}}
                    data-modelId="{{ $postCatalogue->id }}"
                  />
              </td>
              <td class="text-center"> 
                  <a href="{{ route('post.catalogue.edit', $postCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('post.catalogue.delete', $postCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              </td>
          </tr>
          @endforeach
      @endif
  </tbody>
</table>
{{-- {{  $postCatalogues->links('pagination::bootstrap-4') }} --}}
