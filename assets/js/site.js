$(document).ready(function(){
  //alert('Hello World!');
});

$('#input-tags').tagsinput({
    tagClass: 'h6 my-1 badge badge-pill badge-primary',
    trimValue: true,
    maxChars: 24,
    maxTags: 32,
    cancelConfirmKeysOnEmpty: false
});