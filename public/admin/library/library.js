(function($){
  var VM = {};
  var doccument = $(document)
  VM.switchery = () =>{
    $('.js-switch').each(function(){
      var switchery = new Switchery(this, { color: '#1AB394' });
    })
  }
  doccument.ready(function(){
    VM.switchery();
  });
})(jQuery);