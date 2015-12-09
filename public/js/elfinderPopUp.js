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
var anMarkitUp = {
	Elfinder: function(updateId){
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
};

function markitupElfinderFile(){
   anMarkitUp.Elfinder('_markitUpFile');
}
function markitupElfinder(){
    anMarkitUp.Elfinder('_markitUp');
}

// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    switch(requestingField){
        case '_markitUp':{
            if (typeof $.fn.markItUp !== 'undefined') $.markItUp({replaceWith: '<img src="/' + filePath +'" alt="[![Описание]!]" />'});
            break;
        }
        case '_markitUpFile':{
            if (typeof $.fn.markItUp !== 'undefined'){
                $.markItUp({replaceWith: '<a href="/' + filePath +'" title="[![Описание]!]" />[![Текст ссылки]!]</a>'});
            }
            break;
        }
        default:{
            $("#" + requestingField).val(filePath);
            $("#" + requestingField + 'Src').attr('src', '/' + filePath).parent().show();
        }
    }
}