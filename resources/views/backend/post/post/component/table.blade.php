<table class="table table-striped table-bordered">
  <thead>
  <tr>
      <th>
          <input type="checkbox" value="" id="checkAll" class="input-checkbox">
      </th>
      <th>{{__('messages.tableName') }}</th>
      <th>{{__('messages.tableStatus') }}</th>
      <th class="text-center">{{__('messages.tableAction') }}</th>
  </tr> 
  </thead>
  <tbody>
      @if(isset($posts) && is_object($posts))
          @foreach($posts as $post)
          <tr>
              <td>
                  <input type="checkbox" value="{{ $post->id }}" class="input-checkbox checkBoxItem">
              </td>
              <td>
                <div class="flex flex-wrap gap-4">
                    <div class="object-cover max-w-80">
                        <img src="{{ $post->image}}" alt="">
                    </div>
                    <div class="">
                        <div>
                            <p class="text-[#99c3ff] font-semibold text-[14px]">{{ $post->name }}</p>
                        </div>
                        <div>
                            <span class="text-red-400">{{ __('messages.catalogue') }}: </span>
                            @php
                                $sortedPostCatalogues = $post->post_catalogues->sortBy('lft');
                            @endphp
                            @foreach($post->post_catalogues as $val)
                                @foreach($val->post_catalogue_language as $cat)
                                    <a href="{{route('post.index', ['post_catalogue_id' => $val->id])}}">
                                        {{$cat->name}}|
                                    </a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
              </td>
              {{-- <td class="">

                <input type="text" name="order" class="form-control"
                        value="{{$post->order}}"
                        data-id="{{$post->id}}"
                        data-model="Post"
                >
              </td> --}}
              <td class="text-center js-switch-{{ $post->id }}"> 
                  <input type="checkbox" value="{{ $post->publish }}" class="js-switch status" data-field="publish" 
                  data-model="Post"  
                    {{ ($post->publish == 2) ? 'checked' : ''}}
                    data-modelId="{{ $post->id }}"
                  />
              </td>
              <td class="text-center"> 
                  <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              </td>
          </tr>
          @endforeach
      @endif
  </tbody>
</table>
{{  $posts->links('backend.pagination.paginate') }}