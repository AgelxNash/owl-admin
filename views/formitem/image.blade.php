<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }} an-images">
    <label for="{{ $name }}">{{ $label }}</label>
    <div>
        <div class="preview-image" @if($value) style="display:block" @endif>
            <img src="/{{ $value }}" width="200" id="imgField{{ $name }}Src">
        </div>
        <div class="margin-bottom-5"></div>
        <div class="upload-button popup_selector" data-inputid="imgField{{ $name }}">
            <span class="btn btn-xs btn-primary">Выбрать +</span>
            <input class="upload-link__inp" type="button"/>
            <input type="hidden" name="{{ $name }}" value="{{ $value }}" id="imgField{{ $name }}">
        </div>
    </div>
</div>
<style>
.an-images .preview-image{
    display: none;
}
.an-images .upload-button{
    display: inline-block;
    overflow: hidden;
    position: relative;
    text-decoration: none
}

.an-images .upload-button .upload-link__inp {
    top: -10px;
    right: -40px;
    z-index: 2;
    position: absolute;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
    font-size: 50px;
}
</style>