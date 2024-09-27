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
      @if(isset($languages) && is_object($languages))
          @foreach($languages as $language)
          <tr>
              <td>
                  <input type="checkbox" value="{{ $language->id }}" class="input-checkbox checkBoxItem">
              </td>
              <td class="max-w-[50px]">
                <span class="image object-cover">
                    <img src="{{ $language->image }}" alt="">
                </span>
            </td>
              <td>
                  {{ $language->name }}
              </td>
              <td>
                  {{ $language->canonical }}
              </td>
              <td class="text-center js-switch-{{ $language->id }}"> 
                  <input type="checkbox" value="{{ $language->publish }}" class="js-switch status" data-field="publish" 
                  data-model="Language"  
                    {{ ($language->publish == 2) ? 'checked' : ''}}
                    data-modelId="{{ $language->id }}"
                  />
              </td>
              <td class="text-center"> 
                  <a href="{{ route('language.edit', $language->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('language.delete', $language->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              </td>
          </tr>
          @endforeach
      @endif
  </tbody>
</table>
{{-- {{  $languages->links('pagination::bootstrap-4') }} --}}
