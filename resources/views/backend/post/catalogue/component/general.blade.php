<div class="row">
  <div class="col-lg-12">
      <div class="form-row">
          <label for="" class="control-label text-left">Tiêu đề nhóm bài viết<span class="text-danger">(*)</span></label>
          <input 
              type="text"
              name="name"
              value="{{ old('description', ($postCatalogue->name) ?? '' ) }}"
              class="form-control"
              placeholder=""
              autocomplete="off"
          >
      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <div class="form-row">
          <label for="" class="control-label text-left">Mô tả ngắn<span class="text-danger">(*)</span></label>
          <textarea 
              type="text"
              name="description"
              class="form-control ckeditor"
              value="{{ old('description', ($postCatalogue->description) ?? '' ) }}"
              placeholder=""
              autocomplete="off"
              id="description"
              >
          </textarea>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <div class="form-row">
          <label for="" class="control-label text-left">Nội dung<span class="text-danger">(*)</span></label>
          <textarea 
              rows="6"
              cols="450"
              type="text"
              name="content"    
              class="form-control ckeditor"
              value="{{ old('description', ($postCatalogue->content) ?? '' ) }}"
              placeholder=""
              autocomplete="off"
              id="content"
              >
          </textarea>
      </div>
  </div>
</div>