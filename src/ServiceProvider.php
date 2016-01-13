<?php namespace AgelxNash\Admin;

use Illuminate\Support\ServiceProvider as BaseProvider;
use SleepingOwl\Admin\FormItems\FormItem;
use SleepingOwl\Admin\Display\AdminDisplay;
use Route;

class ServiceProvider extends BaseProvider
{
	public function register()
	{
		FormItem::register('anOneSelect', FormItems\oneSelect::class);
		FormItem::register('anSelect', FormItems\Select::class);
		FormItem::register('anSeo', FormItems\Seo::class);
		FormItem::register('anJsonField', FormItems\JsonField::class);
		FormItem::register('anGalleryList', FormItems\GalleryList::class);
		FormItem::register('anVideoList', FormItems\VideoList::class);
		FormItem::register('anMarkitUp', FormItems\MarkitUp::class);
		FormItem::register('anImage', FormItems\Image::class);
		FormItem::register('yaMap', FormItems\YaMap::class);
		
		AdminDisplay::register('datatablesSearchAsync', Display\DatatablesSearchAsync::class);
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