<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\AssetManager\AssetManager;

Class Select extends \SleepingOwl\Admin\FormItems\Select{
	public function initialize()
	{
		parent::initialize();
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/select.js'));
	}
}