(function($){
  "use strict";
  var VM = {};
  VM.setupCkeditor = () => {
    if($('.ckeditor')){
      $('.ckeditor').each(function(){
        let editor = $(this);
        let elementId = editor.attr('id')
        VM.ckeditor4(elementId);
      });
    }
  }
  VM.ckeditor4 = (elementId) => {
    // if(typeof(elementHeight) == 'undefined'){
    //     elementHeight = 500;
    // }
    CKEDITOR.replace( elementId, {
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

  $(document).ready(function(){
    VM.uploadImageToInput();
    VM.setupCkeditor();
  })

})(jQuery)