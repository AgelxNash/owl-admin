<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\FormItems\NamedFormItem;
use SleepingOwl\Admin\AssetManager\AssetManager;
use Input;

/***
 * Class VideoList
 * @package AgelxNash\Admin
 * @see https://github.com/avilaj/ocsport/blob/master/app/admin/TetxList.php
 *
 * trait VideoListModel{
 *  	public function getVideosAttribute($value){
 *			return preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
 *		}
 *		public function setVideosAttribute($photos){
 *			$this->attributes['videos'] = implode(',', $photos);
 *		}
 * }
 */
class VideoList extends NamedFormItem
{
	protected $view = 'videolist';
	public function initialize()
	{
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/VideoList.js'));
		AssetManager::addScript('admin::default/js/formitems/image/Sortable.min.js');
		AssetManager::addScript('admin::default/js/formitems/image/sortable.jquery.binding.js');
	}
	public function render () {
		$params = $this->getParams();
		return view('an-admin::formitem.'.$this->view, $params);
	}
	public function save()
	{
		$name = $this->name();
		$value = Input::get($name, '');
		if ( ! empty($value))
		{
			$value = explode(',', $value);
		} else
		{
			$value = [];
		}
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
			$value = preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
		}
		return $value;
	}
}