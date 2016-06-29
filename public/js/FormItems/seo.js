(function( $ ) {
    $.fn.limitlength = function(length) {

        $(this).after('<div class="informer"></div>');
        var informer = this.next('.informer'),
            remaining = length -  $(this).val().length;
        informer.css('font-size','11px');
        informer.append((remaining > 0 ? "Осталось" : "Лишних") + " <strong>"+  Math.abs(remaining) + "</strong> символов");
        if(remaining <= 10) { informer.css("color","red"); }
        $(this).on('keyup',function(event){
            var remaining = length -  $(this).val().length;
            informer.html((remaining > 0 ? "Осталось" : "Лишних") + " <strong>"+  Math.abs(remaining) + "</strong> символов");
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