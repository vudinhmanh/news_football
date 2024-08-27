
<div class="ibox">
    <div class="ibox-title">
        <h5>CHỌN DANH MỤC CHA</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb-[15px]">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="text-danger text-[11px] italic mb-[10px] block">Chọn Root nếu không có danh mục cha</span>
                    <select name="parentid" class="form-control setupSelect2">
                        @foreach($dropdown as $key => $val)
                        <option
                            {{ 
                                $key == old('parentid', (isset($postCatalogue->parentid)) ? $postCatalogue->parentid : '') ? 'selected' : '' 
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
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Chọn ảnh đại diện</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb-[15px]">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="object-cover">
                        <span class="image-target">
                            <img src="{{ old('image', isset($postCatalogue->image) ? $postCatalogue->image : '/Admin/img/no-image.png') }}" alt="">
                        </span>
                        <input class="upload-image" type="hidden" name="image" id="" value="{{ old('image', ($postCatalogue->image) ?? '') }}">
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Cấu hình nâng cao</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb-[15px]">
            <div class="col-lg-12">
                <div class="form-row mb-[15px]">
                    <select name="publish" class="form-control setupSelect2 ">
                        @foreach(config('apps.general.publish') as $key =>$val)
                            <option  
                                {{ 
                                    $key == old('publish', (isset($postCatalogue->publish)) ? $postCatalogue->publish : '') ? 'selected' : '' 
                                }}
                                    value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <select name="follow" class="form-control setupSelect2">
                        @foreach(config('apps.general.follow') as $key =>$val)
                            <option 
                            {{ 
                                $key == old('follow', (isset($postCatalogue->follow)) ? $postCatalogue->follow : '') ? 'selected' : '' 
                            }}
                                value="{{ $key }}">{{ $val }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>