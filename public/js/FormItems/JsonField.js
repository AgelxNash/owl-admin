$(function ()
{
    $('.jsonFieldMultiple').each(function (index, item)
    {
        var $item = $(item);
        var RenderFieldsTpl = $item.find('.RenderJsonField').first().html();
        var $group = $item.closest('.json-field-list');
        var $innerGroup = $item.find('.json-field-list');
        var $errors = $item.find('.errors');
        var $input = $item.find('.jsonValue');
        var updateValue = function ()
        {
            var values = [];
            $item.find('fieldset').each(function (index, thumb) {
                var $thumb = $(thumb), data = {};
                $thumb.find('input.dataUrl').each(function(){
                    var key = $(this).attr('type');
                    data[key] = $(this).val();
                });
                values.push(data);
            });
            $input.val(JSON.stringify(values));
        };
        var urlItem = function (src, url) {
            return renderTPL(RenderFieldsTpl, {
                num: (new Date).getTime()
            });
        };
        $item.on('click', '.json-field-add', function (e) {
            e.preventDefault();
            $innerGroup.append(urlItem());
        });

        $item.on('click', '.json-field-remove', function (e)
        {
            e.preventDefault();
            $(this).closest('.json-field-item').remove();
            updateValue();
        });
        $item.on('focusout', '.dataUrl', function (e)
        {
            e.preventDefault();
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