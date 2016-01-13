<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\FormItems\NamedFormItem;
use SleepingOwl\Admin\AssetManager\AssetManager;

/***
 * Class YaMap
 * @package AgelxNash\Admin\FormItems
 *
 * @see: https://github.com/Pathologic/YandexMapCustomTV
 */
class YaMap extends NamedFormItem
{
	protected $view = 'yaMap';
	protected $zoom = 15;

	public $value;

	public function initialize()
	{
		parent::initialize();

		AssetManager::addScript('//api-maps.yandex.ru/2.1/?lang=ru_RU');
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/YaMap.js'));
	}

	public function zoom($zoom = null)
	{
		if (is_null($zoom))
		{
			return $this->zoom;
		}
		$this->zoom = $zoom;
		return $this;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'zoom'  => $this->zoom
		];
	}

	public function render () {
		$params = $this->getParams();
		return view('an-admin::formitem.'.$this->view, $params)->render();
	}
}