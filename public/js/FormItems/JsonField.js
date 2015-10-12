$(function ()
{
    $('.json-field').each(function (index, item)
    {
        var $item = $(item);
        var $innerGroup = $item.find('.json-field-list');
        var $errors = $item.find('.errors');
        var $input = $item.find('.jsonValue');

        var updateValue = function ()
        {
            var values = [];
            $item.find('.json-field-item').each(function (index, item)
            {
                var key = $(item).find('.json-field-item-key').val();
                var val = $(item).find('.json-field-item-val').val();
                if (key !== '') {
                    var field = {
                        key: key,
                        val: val
                    };
                    values.push(field);
                }
            });
            $input.val(JSON.stringify(values));
        };
        var urlItem = function (key, val) {
            var a = '';
            a+= '<div class="row form-group json-field-item">'
            a+= '<input class="input formControl json-field-item-key" type="text" placeholder="propiedad" value="'+key+'"/>'
            a+= '<input class="input formControl json-field-item-val" type="text" placeholder="valor" value="'+val+'"/>'
            a+= '<a href="#" class="json-field-remove">Remove</a>'
            a+= '</div>'
            return a;
        };
        $('.json-field-add').click(function (e) {
            $innerGroup.append(urlItem('',''));
        });

        $item.on('click', '.json-field-remove', function (e)
        {
            e.preventDefault();
            $(this).closest('.json-field-item').remove();
            updateValue();
        });
        $item.on('focusout', 'input', function (e)
        {
            e.preventDefault();
            console.log('works');
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