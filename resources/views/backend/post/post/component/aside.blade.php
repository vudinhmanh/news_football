
<div class="ibox">
    <div class="ibox-title">
        <h5>{{ __('messages.parent') }}</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb-[15px]">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="text-danger notice" >*{{ __('messages.parentNotice') }}</span>
                    <select name="post_catalogue_id" class="form-control setupSelect2">
                        @foreach($dropdown as $key => $val)
                        <option
                            {{ 
                                $key == old('post_catalogue_id', (isset($post->post_catalogue_id)) ? $post->post_catalogue_id : '') ? 'selected' : '' 
                            }}
                                value="{{ $key }}"
                        >
                            {{ $val }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
          </div>
          @php
            $catalogue = [];
            if(isset($post)){
                foreach($post->post_catalogues as $key => $value){
                    $catalogue[] = $value->id;
                }
            }    
          @endphp
          <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label">{{ __('messages.subparent') }}</label>
                    <select multiple name="catalogue[]" class="form-control setupSelect2">
                        @foreach($dropdown as $key => $val)
                        <option
                            @if (is_array(old('catalogue', (isset($catalogue) && count($catalogue)) ? $catalogue : [])) 
                                &&isset($post) && $key !== $post->post_catalogue_id 
                                && in_array($key, old('catalogue', isset($catalogue) ? $catalogue : [])))
                                selected
                            @endif
                                value="{{ $key }}"
                                id=""
                        >
                            {{ $val }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
          </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>{{ __('messages.image') }}</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb-[15px]">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="object-cover">
                        <span class="image-target">
                            <img src="{{ old('image', isset($post->image) ? $post->image : '/Admin/img/no-image.png') }}" alt="">
                        </span>
                        <input class="upload-image" type="hidden" name="image" id="" value="{{ old('image', ($post->image) ?? '') }}">
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>{{ __('messages.advange') }}</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb-[15px]">
            <div class="col-lg-12">
                <div class="form-row mb-[15px]">
                    <select name="publish" class="form-control setupSelect2 ">
                        @foreach(__('messages.publish') as $key =>$val)
                            <option  
                                {{ 
                                    $key == old('publish', (isset($post->publish)) ? $post->publish : '') ? 'selected' : '' 
                                }}
                                    value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>