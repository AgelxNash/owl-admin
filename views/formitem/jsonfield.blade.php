<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>
	<div class="json-field">
		<div class="json-field-list">
			@if($value)
				@foreach ($value as $item)
				<div class="row form-group json-field-item">
					<input class="formControl json-field-item-key" type="text" placeholder="propiedad" value="{{ $item->key }}"/>
					<input class="formControl json-field-item-val" type="text" placeholder="valor" value="{{ $item->val }}"/>
					<a href="#" class="json-field-remove">Remove</a>
				</div>
				@endforeach
			@endif
			<div class="row form-group json-field-item">
				<input class="formControl json-field-item-key" type="text" placeholder="Propiedad" value=""/>
				<input class="formControl json-field-item-val" type="text" placeholder="Valor" value=""/>
				<a href="#" class="json-field-remove">Remove</a>
			</div>
		</div>
		<div>
			<div class="btn btn-primary json-field-add"><i class="fa fa-plus"></i> Añadir </div>
		</div>
		<input name="{{ $name }}" class="jsonValue" type="hidden" value="{{ json_encode($value) }}">
		<div class="errors">
			@include(AdminTemplate::view('formitem.errors'))
		</div>
	</div>
</div>