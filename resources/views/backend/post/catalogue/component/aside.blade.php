<div class="ibox">
  <div class="ibox-content">
      <div class="row mb-[15px]">
          <div class="col-lg-12">
              <div class="form-row">
                  <label for="" class="control-label text-left">Chọn danh mục cha<span class="text-danger">(*)</span><br>
                   <span class="text-danger text-[11px] italic mb-[10px] block">Chọn Root nếu không có danh mục cha</span>
                   <select name="" class="form-control setupSelect2">
                    <option value="0">Chọn danh mục cha</option>
                    <option value="">Root</option>
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
                    <span>
                        <img src="/Admin/img/no-image.png" alt="">
                    </span>
                    <input type="hidden" name="image" id="" value="">
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
                <select name="" class="form-control setupSelect2 ">
                    @foreach(config('apps.general.publish') as $key =>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
               </select>
            </div>
            <div class="form-row">
                <select name="" class="form-control setupSelect2">
                    @foreach(config('apps.general.follow') as $key =>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
               </select>
            </div>
        </div>
      </div>
</div>
</div>