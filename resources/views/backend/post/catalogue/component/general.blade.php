<div class="row">
  <div class="col-lg-12">
      <div class="form-row">
          <label for="" class="control-label text-left">Tiêu đề nhóm bài viết<span class="text-danger">(*)</span></label>
          <input 
              type="text"
              name="name"
              value="{{ old('name', ($postCatalogue->name) ?? '' ) }}"
              class="form-control"
              placeholder=""
              autocomplete="off"
              data-height="110"
          >
      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <div class="form-row">
          <label for="" class="control-label text-left">Mô tả ngắn</label>
          <textarea 
              type="text"
              name="description"
              class="form-control ckeditor description"
              placeholder=""
              autocomplete="off"
              data-height="500"
                id="description"
              >
              {{ old('description', ($postCatalogue->description) ?? '') }}
          </textarea>
      </div>
  </div>
</div>
<div class="row mt-5">
  <div class="col-lg-12">
      <div class="form-row">
        <div class="flex justify-between align-middle">
          <label for="" class="control-label text-left">Nội dung</label>
          <a href="" class="multipleUploadImageCkeditor" data-target="ckContent">Upload nhiều hình ảnh</a>
        </div>
          <textarea 
              rows="6"
              cols="450"
              type="text"   
              name="content"    
              class="form-control ckeditor"
              placeholder=""
              autocomplete="off"
              id="ckContent"
              >{{ old('content', ($postCatalogue->content) ?? '') }}</textarea>
      </div>
  </div>
</div>