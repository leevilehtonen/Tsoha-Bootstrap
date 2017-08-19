$(document).ready(function(){
    $('form.destroy-form').on('submit', function (submit) {
        var confirm_message = $(this).attr('data-confirm');
        if (!confirm(confirm_message)) {
            submit.preventDefault();
        }
    });
});

$('#input-tags').tagsinput({
    tagClass: 'h6 my-1 badge badge-pill badge-primary',
    trimValue: true,
    maxChars: 24,
    maxTags: 32,
    cancelConfirmKeysOnEmpty: false
});