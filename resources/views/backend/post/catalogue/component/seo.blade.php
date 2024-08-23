<div class="ibox">
  <div class="ibox-title">
      <h5 class="uppercase">Cấu hình SEO</h5>
  </div>
  <div class="ibox-content">
      <div>
          <div>
              <div>
                  <p class="text-[20px] text-[#1a0dab]">
                      Học Laravel Framework - Học PHP
                  </p>
              </div>
              <div>
                  <p class="text-green-500 mb-[8px]">
                      https://toidicode.com/hoc-laravel
                  </p>
              </div>
              <div>
                  <p class="text-[14px]">
                      Laravel là một php framework mới, ra đời vào tháng 04/2011.Ngay khi vừa mới ra mắt thì nó đã được cộng đồng chú ý đến bởi nhiều đặc điểm và tính năng mới ...
                  </p>
              </div>
          </div>
          <div>
              <div class="row mb-[15px]">
                  <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                  <span class="">Tiêu đề SEO</span>
                                  <span class="count_meta-title">0 ký tự</span>
                              </div>
                          </label>
                          <input 
                              type="text"
                              name="meta_title"
                              value="{{ old('meta_title', ($postCatalogue->name) ?? '' ) }}"
                              class="form-control"
                              placeholder=""
                              autocomplete="off"
                          >
                      </div>
                  </div>
              </div>
              <div class="row mb-[15px]">
                  <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                  <span class="">Từ khoá SEO</span>
                                  <span class="count_meta-title">0 ký tự</span>
                              </div>
                          </label>
                          <input 
                              type="text"
                              name="meta_keyword"
                              value="{{ old('meta_keyword', ($postCatalogue->name) ?? '' ) }}"
                              class="form-control"
                              placeholder=""
                              autocomplete="off"
                          >
                      </div>
                  </div>
              </div>
              <div class="row mb-[15px]">
                  <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                  <span class="">Mô tả SEO</span>
                                  <span class="count_meta-description">0 ký tự</span>
                              </div>
                          </label>
                          <textarea 
                              rows="6"
                              cols="450"
                              type="text"
                              name="meta-description"
                              value="{{ old('meta-description', ($postCatalogue->name) ?? '' ) }}"
                              class="form-control"
                              placeholder=""
                              autocomplete="off"
                          >
                          </textarea>
                      </div>
                  </div>
              </div>
              <div class="row mb-[15px]">
                  <div class="col-lg-12">
                      <div class="form-row">
                          <label for="" class="block control-label">
                              <div class="flex justify-between items-center">
                                  <span class="">Đường dẫn</span>
                              </div>
                          </label>
                          <input 
                              type="text"
                              name="canonical"
                              value="{{ old('canonicaln', ($postCatalogue->canonical) ?? '' ) }}"
                              class="form-control"
                              placeholder=""
                              autocomplete="off"
                          >
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>