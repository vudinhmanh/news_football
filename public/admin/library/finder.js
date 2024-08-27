(function($){
  "use strict";
  var VM = {};
  VM.setupCkeditor = () => {
    if($('.ckeditor')){
      $('.ckeditor').each(function(){
        let editor = $(this);
        let elementId = editor.attr('id');
        let elementHeight = editor.attr('data-height');
        VM.ckeditor4(elementId, elementHeight);
      });
    }
  }
  //Upload nhiều ảnh ckeditor
  VM.multipleUploadImageCkeditor = () => {
    $(document).on('click', '.multipleUploadImageCkeditor', function(e){
      let object = $(this);
      let target = object.attr('data-target');
      VM.browseServerCkeditor(object, 'Images', target);
      e.preventDefault();
    });
  }

  VM.ckeditor4 = (elementId, elementHeight) => {
    if(typeof(elementHeight) == 'undefined'){
        elementHeight = 500;
    }
    CKEDITOR.replace( elementId, {
        autoUpdateElement: false,
        height: elementHeight,
        removeButtons: '',
        entities: true,
        allowedContent: true,
        toolbarGroups: [
            { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker','undo' ] },
            { name: 'links' },
            { name: 'insert' },
            { name: 'forms' },
            { name: 'tools' },
            { name: 'document',    groups: [ 'mode', 'document', 'doctools'] },
            { name: 'others' },
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup','colors','styles','indent'  ] },
            { name: 'paragraph',   groups: [ 'list', '', 'blocks', 'align', 'bidi' ] },
        ],
        removeButtons: 'Save,NewPage,Pdf,Preview,Print,Find,Replace,CreateDiv,SelectAll,Symbol,Block,Button,Language',
        removePlugins: "exportpdf",
    
    });
}
  VM.uploadImageToInput = () => {
    $('.upload-image').click(function(){
      let input = $(this);
      let type = input.attr('data-type');
      VM.setupCkFinder2(input, type);
    });
  }
  VM.uploadImageAvatar = () => {
    $('.image-target').click(function(){
      let input = $(this);
      let type = 'Images';
      VM.browseServerAvatar(input, type);
    })
  }

  VM.setupCkFinder2 = (object ,type) => {
    if(typeof(type) == 'undefined'){
      type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function(fileUrl, data){
      object.val(fileUrl);
    }
    finder.popup();
  }

  VM.browseServerAvatar = (object ,type) => {
    if(typeof(type) == 'undefined'){
      type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function(fileUrl, data){
      object.find('img').attr('src', fileUrl);
      object.siblings('input').val(fileUrl);
    }
    finder.popup();
  }
  VM.browseServerCkeditor = (object, type, target) => {
    if(typeof(type) == 'undefined'){
      type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function(fileUrl, data, allFiles){
      let html = '';
      for(var i = 0; i < allFiles.length; i++){
        var image = allFiles[i].url;
        html += '<div class="image-content">'
        html += '<figure>'
        html += '<img src="'+image+'" alt="'+image+'" />'
        html += '<figcaption>Nhập vào mô tả cho ảnh</figcaption>'
        html += '</figure>'
        html += '</div>'
      }
      CKEDITOR.instances[target].insertHtml(html)
    }
    finder.popup();
  }

  $(document).ready(function(){
    VM.uploadImageToInput();
    VM.setupCkeditor();
    VM.uploadImageAvatar(); 
    VM.multipleUploadImageCkeditor();
  })

})(jQuery);