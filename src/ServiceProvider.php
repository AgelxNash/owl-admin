<?php namespace AgelxNash\Admin;

use Illuminate\Support\ServiceProvider as BaseProvider;
use SleepingOwl\Admin\FormItems\FormItem;
use SleepingOwl\Admin\Display\AdminDisplay;
use Route;

class ServiceProvider extends BaseProvider
{
	public function register()
	{
		FormItem::register('anOneSelect', 'AgelxNash\Admin\FormItems\oneSelect');
		FormItem::register('anSelect', 'AgelxNash\Admin\FormItems\Select');
		FormItem::register('anSeo', 'AgelxNash\Admin\FormItems\Seo');
		FormItem::register('anJsonField', 'AgelxNash\Admin\FormItems\JsonField');
		FormItem::register('anGalleryList', 'AgelxNash\Admin\FormItems\GalleryList');
		FormItem::register('anVideoList', 'AgelxNash\Admin\FormItems\VideoList');
		FormItem::register('anMarkitUp', 'AgelxNash\Admin\FormItems\MarkitUp');
		FormItem::register('anImage', 'AgelxNash\Admin\FormItems\Image');

		AdminDisplay::register('datatablesSearchAsync', '\AgelxNash\Admin\Display\DatatablesSearchAsync');
		$routesFile = __DIR__ . '/Http/routes.php';
		if (file_exists($routesFile)) require $routesFile;
	}

	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../views', 'an-admin');
		$this->loadTranslationsFrom(__DIR__ . '/../lang', 'an-admin');
		$this->publishes([
			__DIR__ . '/../public/' => public_path('packages/agelxnash/admin/'),
		], 'an-admin');
	}

}