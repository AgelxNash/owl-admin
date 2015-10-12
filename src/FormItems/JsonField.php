<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\FormItems\NamedFormItem;
use SleepingOwl\Admin\AssetManager\AssetManager;
use Input;

/***
 * Class JsonField
 * @package AgelxNash\Admin\FormItems
 * @see https://github.com/avilaj/ocsport/blob/master/app/admin/JsonField.php
 *
 * trait JsonModel{
 * 		public function setSpecsAttribute($value) {
 *	 		$this->attributes['specs'] = json_encode($value);
 *		}
 *		public function getSpecsAttribute($value) {
 *			return json_decode($value);
 *		}
 * }
 */
class JsonField extends NamedFormItem
{
	protected $view = 'jsonfield';
	public function initialize()
	{
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/JsonField.js'));
		AssetManager::addScript('admin::default/js/formitems/image/Sortable.min.js');
		AssetManager::addScript('admin::default/js/formitems/image/sortable.jquery.binding.js');
		// AssetManager::addStyle('admin::default/css/formitems/image/images.css');
	}
	public function render () {
		$params = $this->getParams();
		return view('an-admin::formitem.'.$this->view, $params)->render();
	}
	public function save()
	{
		$name = $this->name();
		$value = Input::get($name, '');
		Input::merge([$name => $value]);
		parent::save();
	}
	public function value()
	{
		$value = parent::value();
		if (is_null($value))
		{
			$value = [];
		}
		if (is_string($value))
		{
			$value = json_decode($value);
		}
		return $value;
	}
}