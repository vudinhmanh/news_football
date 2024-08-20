(function($){
  var VM = {};
  var document = $(document)
  VM.switchery = () =>{
    $('.js-switch').each(function(){
      var switchery = new Switchery(this, { color: '#1AB394' });
    })
  }
  // họn tất cả các phần tử có class là setupSelect2 và khởi tạo thư viện Select2
  VM.select2 = () => {
    $('.setupSelect2').select2();
  }


  document.ready(function(){
    VM.switchery();
    VM.select2();
  });
})(jQuery);