<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }} an-yaMap">
    <label for="yaMapInput-{{ $name }}">{{ $label ?? '' }}</label>
    <input style="display:none;" id="yaMapInput-{{ $name }}" name="{{ $name }}" value="{{ empty($value) ? '0,0' : $value }}">
    <div id="yaMap-{{ $name }}" style="width:100%;height:400px;"></div>
    <script type="text/javascript">
    (function($) {
        $('#yaMap-{{ $name }}').ymapTV({
            'coords':'{{ empty($value) ? '0,0' : $value }}',
            'tv':'#yaMapInput-{{ $name }}',
            'zoom': '{{$zoom}}'
        });
    })(jQuery)
    </script>
</div>

