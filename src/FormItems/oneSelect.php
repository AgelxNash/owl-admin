<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\AssetManager\AssetManager;

Class oneSelect extends \SleepingOwl\Admin\FormItems\MultiSelect{
	protected $view = 'oneselect';

	public function initialize()
	{
		parent::initialize();
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/select.js'));
	}

	/** @return array */
	public function value()
	{
		$value = parent::value();
		if(is_array($value)){
			$value = get_key($value, 0, '');
		}
		return [$value];
	}

	public function render()
	{
		$params = $this->getParams();

		return view('an-admin::formitem.' . $this->view, $params)->render();
	}
}