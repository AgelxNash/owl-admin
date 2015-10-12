(function( $ ) {
    $.fn.limitlength = function(length) {

        $(this).after('<div class="informer"></div>');
        var informer = this.next('.informer');
        informer.css('font-size','11px');
        informer.append("Осталось <strong>"+  length+"</strong> символов");
        $(this).on('keyup',function(event){
            if($(this).val().length > length){
                $(this).val($(this).val().substr(0, length));
            }
            var remaining = length -  $(this).val().length;
            informer.html("Осталось <strong>"+  remaining+"</strong> символов");
            if(remaining <= 10) { informer.css("color","red"); }
            else {
                event.preventDefault();
                informer.css("color","black");
            }
        });
    };
}( jQuery ));

jQuery(document).ready(function($)  {
    $('#seo_title').limitlength(60);
    $('#seo_description').limitlength(160);
});