<div class="form-group imageUploadMultiple {{ $errors->has($name) ? 'has-error' : '' }}"data-target="{{ route('admin.formitems.image.uploadImage') }}" data-token="{{ csrf_token() }}">
    <label for="{{ $name }}">{{ $label }}</label>
	<script type="text/html" class="RenderPhoto">
        <div class="col-xs-6 col-md-3 imageThumbnail">
            <div class="thumbnail">
                <img data-src="<%=src%>" src="<%=url%>" />
                @foreach($fields as $field)
                    <?php
					    $field_name = get_key($field, 'name', '', 'is_scalar');
						$field_label = get_key($field, 'label', '', 'is_scalar');
					?>
					<div class="form-group">
					    <label for="dynamic-field-{{ $name }}-<%=num%>-{{ $field_name }}" class="control-label"><small>{{ $field_label }}</small></label>
					    @if(get_key($field, 'type', 'input', 'is_scalar') == 'input')
                            <input class="form-control dataUrl" id="dynamic-field-{{ $name }}-<%=num%>-{{ $field_name }}" placeholder="{{ $field_label }}" data-name="{{ $field_name }}" value=""/>
					    @endif
					</div>
				@endforeach
                <a href="#" class="btn-sm btn-danger imageRemove"><span aria-hidden="true">&times;</span> {{ trans('an-admin::formitems.gallerylist.remove') }}</a>
            </div>
        </div>
    </script>
	<div class="row images-group">
	    @foreach ($value as $num => $image)
		    <div class="col-xs-6 col-md-3 imageThumbnail">
			    <div class="thumbnail">
				    <img data-src="{{ $image->src }}" src="{{ asset($image->src) }}" />
					@foreach($fields as $field)
					    <?php
					        $field_name = get_key($field, 'name', '', 'is_scalar');
						    $field_label = get_key($field, 'label', '', 'is_scalar');
				        ?>
					    <div class="form-group">
					        <label for="dynamic-field-{{ $name }}-{{$num}}-{{ $field_name }}" class="control-label"><small>{{ $field_label }}</small></label>
						    @if(get_key($field, 'type', 'input', 'is_scalar') == 'input')
                                <input class="form-control dataUrl" id="dynamic-field-{{ $name }}-{{$num}}-{{ $field_name }}" placeholder="{{ $field_label }}" data-name="{{ $field_name }}" value="{{ $image->$field_name or '' }}"/>
					        @endif
				        </div>
				    @endforeach
					<a href="#" class="btn-sm btn-danger imageRemove"><span aria-hidden="true">&times;</span> {{ trans('an-admin::formitems.gallerylist.remove') }}</a>
				</div>
			</div>
		@endforeach
	</div>
	<div>
	    <div class="btn btn-primary imageBrowse"><i class="fa fa-upload"></i> {{ trans('an-admin::formitems.gallerylist.upload') }}</div>
	</div>
	<input name="{{ $name }}" class="imageValue" type="hidden" value="{{ json_encode($value) }}">
	<div class="errors">
	    @include(AdminTemplate::view('formitem.errors'))
	</div>
</div>