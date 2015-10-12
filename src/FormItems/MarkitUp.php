<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\FormItems\NamedFormItem;
use SleepingOwl\Admin\AssetManager\AssetManager;
use Request;

/***
 * Class JsonField
 * @package AgelxNash\Admin\FormItems
 */
class MarkitUp extends NamedFormItem
{
	protected $view = 'markitup';

	public $value;

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle(asset('packages/agelxnash/admin/colorbox/colorbox.css'));
		AssetManager::addStyle(asset('packages/barryvdh/elfinder/css/elfinder.min.css'));
		AssetManager::addStyle(asset('packages/barryvdh/elfinder/css/theme.css'));
		AssetManager::addStyle(asset('packages/agelxnash/admin/markitup/skins/style.css'));
		AssetManager::addStyle(asset('packages/agelxnash/admin/markitup/sets/style.css'));

		AssetManager::addScript(asset('packages/agelxnash/admin/markitup/jquery.markitup.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/colorbox/jquery.colorbox-min.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/colorbox/i18n/jquery.colorbox-'.config('app.locale').'.js'));
		AssetManager::addScript(asset('packages/barryvdh/elfinder/js/elfinder.min.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/spell/'. (Request::isSecure() ? 'https' : 'http') .'/spell.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/js/spell/'. (Request::isSecure() ? 'https' : 'http') .'.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/js/elfinderPopUp.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/markitup/sets/set.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/markitUp.js'));
	}

	public function render () {
		$params = $this->getParams();
		return view('an-admin::formitem.'.$this->view, $params)->render();
	}
}