<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <div>
        <textarea name="{{ $name }}" class="markItUpArea" id="{{ $name }}" rows="10">{{ $value }}</textarea>
    </div>
    @include(AdminTemplate::view('formitem.errors'))
</div>