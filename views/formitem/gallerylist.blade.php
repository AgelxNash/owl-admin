<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
	<div class="imageUploadMultiple" data-target="{{ route('admin.formitems.image.uploadImage') }}" data-token="{{ csrf_token() }}">
		<script type="text/html" class="RenderPhoto">
            <div class="col-xs-6 col-md-3 imageThumbnail">
                <div class="thumbnail">
                    <img data-src="<%=src%>" src="<%=url%>" />
                    <input class="formControl dataUrl" placeholder="{{ trans('an-admin::formitems.gallerylist.title') }}" type="title" value=""/>
                    <a href="#" class="imageRemove">{{ trans('an-admin::formitems.gallerylist.remove') }}</a>
                </div>
            </div>
        </script>
		<div class="row form-group images-group">
			@foreach ($value as $image)
				<div class="col-xs-6 col-md-3 imageThumbnail">
					<div class="thumbnail">
						<img data-src="{{ $image->src }}" src="{{ asset($image->src) }}" />
						<input class="formControl dataUrl" placeholder="{{ trans('an-admin::formitems.gallerylist.title') }}" type="title" value="{{ $image->title }}"/>
						<a href="#" class="imageRemove">{{ trans('an-admin::formitems.gallerylist.remove') }}</a>
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
</div>