<div class="row">
  <div class="col-lg-12">
      <div class="form-row">
          <label for="" class="control-label text-left">{{ __('messages.title') }}<span class="text-danger">(*)</span></label>
          <input 
              type="text"
              name="name"
              value="{{ old('name', ($post->name) ?? '' ) }}"
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
          <label for="" class="control-label text-left">{{ __('messages.description') }}</label>
          <textarea 
              type="text"
              name="description"
              class="form-control ckeditor description"
              placeholder=""
              autocomplete="off"
              data-height="500"
                id="description"
              >
              {{ old('description', ($post->description) ?? '') }}
          </textarea>
      </div>
  </div>
</div>
<div class="row mt-5">
  <div class="col-lg-12">
      <div class="form-row">
        <div class="flex justify-between align-middle">
          <label for="" class="control-label text-left">{{ __('messages.content') }}</label>
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
              >{{ old('content', ($post->content) ?? '') }}</textarea>
      </div>
  </div>
</div>