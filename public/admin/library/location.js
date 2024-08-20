// Xử lý js khi click vào thành phố sẽ chuuyển quận huyện tương ứng
(function($){
  "use strict";
  var VM = {};
  VM.getLocation = () => {
    $(document).on('change', '.location', function(){
      let _this = $(this);
      let option = {
        'data': {
          'location_id': _this.val(),
        },
        'target' : _this.attr('data-target')
      }
      // console.log(option);
      VM.sendDataTogetLocation(option);
    });
  }

  VM.sendDataTogetLocation = (option) => {
    $.ajax({
      url: '/ajax/location/getLocation',
      type: 'GET',
      data: option,
      dataType: 'json',
      success: function(res) {
        $('.'+option.target).html(res.html);
        if(province_id != '' && option.target == 'districts'){
          $(".districts").val(district_id).trigger('change');
        }
        if(province_id != '' && option.target == 'wards'){
          $(".wards").val(ward_id).trigger('change');
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        console.log('Lỗi' + textStatus + '' + errorThrown)
      }
    })
  }
  VM.loadCity = () => {
    if(province_id != ''){
      $(".province").val(province_id).trigger('change');
    }
  }

  $(document).ready(function(){
    VM.getLocation();
    VM.loadCity();
  });
})(jQuery)