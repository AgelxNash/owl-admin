<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>
	<div class="videoList" data-token="{{ csrf_token() }}">
		<div class="row form-group">
			@foreach ($value as $item)
				<div class="col-xs-6 col-md-3">
					<div class="item" >
						<a data-value="{{ $item }}" href="{{ $item }}">{{ $item }}</a>
						<a href="#" class="videoRemove">&times;</a>
					</div>
				</div>
			@endforeach
		</div>
		<div>
			<div class="btn btn-primary videoAdd"><i class="fa fa-plus"></i> Añadir </div>
		</div>
		<input name="{{ $name }}" class="listValue" type="hidden" value="{{ implode(',', $value) }}">
		<div class="errors">
			@include(AdminTemplate::view('formitem.errors'))
		</div>
	</div>
</div>