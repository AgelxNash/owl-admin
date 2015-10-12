<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\FormItems\NamedFormItem;
use SleepingOwl\Admin\AssetManager\AssetManager;

/***
 * Class JsonField
 * @package AgelxNash\Admin\FormItems
 */
class Image extends NamedFormItem
{
	protected $view = 'image';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle(asset('packages/agelxnash/admin/colorbox/colorbox.css'));
		AssetManager::addStyle(asset('packages/barryvdh/elfinder/css/elfinder.min.css'));
		AssetManager::addStyle(asset('packages/barryvdh/elfinder/css/theme.css'));

		AssetManager::addScript(asset('packages/agelxnash/admin/colorbox/jquery.colorbox-min.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/colorbox/i18n/jquery.colorbox-'.config('app.locale').'.js'));
		AssetManager::addScript(asset('packages/barryvdh/elfinder/js/elfinder.min.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/js/elfinderPopUp.js'));
	}

	public function render () {
		$params = $this->getParams();
		return view('an-admin::formitem.'.$this->view, $params)->render();
	}
}