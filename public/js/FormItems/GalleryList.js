$(function ()
{
    $('.imageUploadMultiple').each(function (index, item)
    {
        var $item = $(item);
        var $group = $item.closest('.form-group');
        var $innerGroup = $item.find('.form-group');
        var $errors = $item.find('.errors');
        var $input = $item.find('.imageValue');
        var flow = new Flow({
            target: $item.data('target'),
            testChunks: false,
            chunkSize: 1024 * 1024 * 1024,
            query: {
                _token: $item.data('token')
            }
        });
        var updateValue = function ()
        {
            var values = [];
            $item.find('.thumbnail').each(function (index, thumb) {
                var $thumb = $(thumb);
                var src = $($thumb.find('img[data-src]')[0]).data('src');
                var url = $($thumb.find('input[type=url]')[0]).val();
                values.push({src: src, url: url});
            })
            console.log('updated');
            $input.val(JSON.stringify(values));
        };
        var urlItem = function (thumb, src, url) {
            var a = '';
            var url = url || '';
            a += '<div class="col-xs-6 col-md-3 imageThumbnail">';
            a += '<div class="thumbnail">';
            a += '<img data-src="'+src+'" src="/'+src+'" />';
            a += '<input class="form-control dataUrl" placeholder="Link" type="url" value="'+url+'"/>';
            a += '<a href="#" class="imageRemove">&times;</a>';
            a += '</div>';
            a += '</div>';
            return a;
        };
        flow.assignBrowse($item.find('.imageBrowse'));
        flow.on('filesSubmitted', function(file) {
            flow.upload();
        });
        flow.on('fileSuccess', function(file,message){
            flow.removeFile(file);

            $errors.html('');
            $group.removeClass('has-error');

            var result = $.parseJSON(message);

            $innerGroup.append( urlItem(result.url, result.value) );
            updateValue();
        });
        flow.on('fileError', function(file, message){
            flow.removeFile(file);

            var response = $.parseJSON(message);
            var errors = '';
            $.each(response, function (index, error)
            {
                errors += '<p class="help-block">' + error + '</p>'
            });
            $errors.html(errors);
            $group.addClass('has-error');
        });

        $item.on('click', '.imageRemove', function (e)
        {
            e.preventDefault();
            $(this).closest('.imageThumbnail').remove();
            updateValue();
        });
        $item.on('focusout', '.dataUrl', function (e)
        {
            e.preventDefault();
            // $(this).closest('.imageThumbnail').remove();
            updateValue();
        });
        $innerGroup.sortable({
            onUpdate: function ()
            {
                updateValue();
            }
        });

    });
});