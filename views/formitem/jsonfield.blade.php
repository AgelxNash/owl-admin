<div class="form-group jsonFieldMultiple {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>
    <script type="text/html" class="RenderJsonField">
        <div class="panel panel-default json-field-item">
            <div class="panel-body">
                <fieldset>
                    @foreach($fields as $field)
                        <?php
                            $field_name = get_key($field, 'name', '', 'is_scalar');
                            $field_label = get_key($field, 'label', '', 'is_scalar');
                        ?>
                        <div class="form-group">
                            <label for="dynamic-field-{{ $name }}-<%=num%>-{{ $field_name }}" class="col-sm-1 control-label"><small>{{ $field_label }}</small></label>
                            <div class="col-sm-11">
                                @if(get_key($field, 'type', 'input', 'is_scalar') == 'input')
                                    <input class="form-control dataUrl" id="dynamic-field-{{ $name }}-<%=num%>-{{ $field_name }}" placeholder="{{ $field_label }}" type="{{ $field_name }}" value=""/>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group text-right">
                        <a href="#" class="btn-sm btn-danger json-field-remove">
                            <span aria-hidden="true">&times;</span> Удалить
                        </a>
                    </div>
                </fieldset>
            </div>
        </div>
    </script>
	<div class="json-field-list form-horizontal">
	    @foreach ($value as $num => $data)
		    <div class="panel panel-default json-field-item">
                <div class="panel-body">
                    <fieldset>
                        @foreach($fields as $field)
                            <?php
                                $field_name = get_key($field, 'name', '', 'is_scalar');
                                $field_label = get_key($field, 'label', '', 'is_scalar');
                            ?>
                            <div class="form-group">
                                <label for="dynamic-field-{{ $name }}-{{$num}}-{{ $field_name }}" class="col-sm-1 control-label"><small>{{ $field_label }}</small></label>
                                <div class="col-sm-11">
                                    @if(get_key($field, 'type', 'input', 'is_scalar') == 'input')
                                        <input class="form-control dataUrl" id="dynamic-field-{{ $name }}-{{$num}}-{{ $field_name }}" placeholder="{{ $field_label }}" type="{{ $field_name }}" value="{{ $data->$field_name or '' }}"/>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group text-right">
                            <a href="#" class="btn-sm btn-danger json-field-remove">
                                <span aria-hidden="true">&times;</span> Удалить
                            </a>
                        </div>
                    </fieldset>
                </div>
            </div>
	    @endforeach
	</div>
	<div>
	    <div class="btn btn-primary json-field-add"><i class="fa fa-plus"></i> Добавить</div>
	</div>
	<input name="{{ $name }}" class="jsonValue" type="hidden" value="{{ json_encode($value) }}">
	<div class="errors">
	    @include(AdminTemplate::view('formitem.errors'))
	</div>
</div>