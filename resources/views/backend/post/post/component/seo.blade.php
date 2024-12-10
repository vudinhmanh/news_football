<div class="ibox">
  <div class="ibox-title">
    <h5 class="uppercase">{{ __('messages.seo') }}</h5>
  </div>
  <div class="ibox-content">
      <div>
          <div>
              <div>
                  <p class="text-[20px] text-[#1a0dab] meta_title">
                    {{ 
                        (old('meta_title',  (isset($post->meta_title)))) ? old('meta_title',  (isset($post->meta_title))): __('messages.seoMetaTitle') 
                    }}
                  </p>
              </div>
              <div>
                  <p class="text-green-500 mb-[8px] canonical">
                    {{ (old('canonical', (isset($post->canonical)))) ? config('app.url').old('canonical').config('app.general.suffix') : __('messages.fillCanonical') }}
                  </p>
              </div>
              {{-- <div>
                  <p class="text-[14px] meta_description">
                    {{ (old('meta_description',  (isset($post->meta_description)))) ? old('meta_description',  (isset($post->meta_description))) : __('messages.fillMetaDescription') }}
                  </p>
              </div> --}}
          </div>
          <div>
              {{-- <div class="row mb-[15px]">
                  <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                <span class="">{{__('messages.seoMetaTitle') }}</span>

                              </div>
                          </label>
                          <input 
                              type="text"
                              name="meta_title"
                              value="{{ old('meta_title', ($post->name) ?? '' ) }}"
                              class="form-control"
                              placeholder=""
                              autocomplete="off"
                          >
                      </div>
                  </div>
              </div> --}}
              {{-- <div class="row mb-[15px]">
                  <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                <span class="">{{__('messages.seoMetaKeyword') }}</span>
                              </div>
                          </label>
                          <input 
                              type="text"
                              name="meta_keyword"
                              value="{{ old('meta_keyword', ($post->name) ?? '' ) }}"
                              class="form-control"
                              placeholder=""
                              autocomplete="off"
                          >
                      </div>
                  </div>
              </div> --}}
              <div class="row mb-[15px]">
                  {{-- <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                <span class="">{{__('messages.seoMetaDescription') }}</span>
                              </div>
                          </label>
                          <textarea 
                              cols="5"
                              rows="5"
                              type="text"
                              name="meta_description"
                              class="form-control"
                              placeholder=""
                              autocomplete="off"
                              >{{ old('meta_description', ($post->meta_description) ?? '') }}</textarea>
                      </div>
                  </div> --}}
              </div>
              <div class="row mb-[15px]">
                  <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                <span class="">{{__('messages.canonical') }} <span class="text-danger">(*)</span></span>
                              </div>
                          </label>
                          <div class="relative w-full">
                            <input 
                                type="text"
                                name="canonical"
                                class="form-control w-full"    
                                placeholder=""  
                                autocomplete="off"
                                value="{{ old('canonical', ($post->canonical) ?? '' ) }}"
                            >
                            <span   
                                class="baseUrl absolute inset-y-0 left-0 flex items-center px-3 bg-slate-200 border-gray-300">
                                {{ config('app.url') }}
                            </span>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>