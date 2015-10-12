$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '50%'
    });
});
function markitupElfinder(){
    var updateId = '_markitUp';
    var elfinderUrl = '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateId;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '50%'
    });
}
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    if(requestingField == '_markitUp') {
        if (typeof $.fn.markItUp !== 'undefined') $.markItUp({replaceWith: '<img src="' + filePath +'" alt="[![Описание]!]" />'});
    } else {
        $("#" + requestingField).val(filePath);
        $("#" + requestingField + 'Src').attr('src', '/' + filePath).parent().show();
    }
}