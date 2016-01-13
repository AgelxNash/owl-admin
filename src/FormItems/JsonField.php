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
	protected $fields = array();
	public function initialize()
	{
		AssetManager::addScript(asset('packages/agelxnash/admin/js/helpers.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/JsonField.js'));
		AssetManager::addScript('admin::default/js/formitems/image/Sortable.min.js');
		AssetManager::addScript('admin::default/js/formitems/image/sortable.jquery.binding.js');
		AssetManager::addStyle(asset('packages/agelxnash/admin/css/FormItems/JsonField.css'));
	}
	public function addField(array $data = array())
	{
		$this->fields[] = $data;
		return $this;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'fields'  => $this->fields
		];
	}
	public function render () {
		return view('an-admin::formitem.'.$this->view, $this->getParams())->render();
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