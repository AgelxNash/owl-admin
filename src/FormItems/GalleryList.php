<?php namespace AgelxNash\Admin\FormItems;

use SleepingOwl\Admin\FormItems\Image;
use SleepingOwl\Admin\AssetManager\AssetManager;

/***
 * Class GalleryList
 * @package AgelxNash\Admin\FormItems
 * @see https://github.com/avilaj/ocsport/blob/master/app/admin/GalleryList.php
 *
 * trit GalleryListModel{
 * 	public function getImagesAttribute($value){
 * 		try {
 * 			$images = json_decode($value);
 * 		} catch (Exception $e) {
 * 			$images = [];
 * 		}
 * 		if (! is_array($images)) {
 * 			$images =[];
 * 		}
 * 		return $images;
 * 	}
 * 	public function setImagesAttribute($photos){
 * 		$cadena = json_encode($photos);
 * 		$this->attributes['images'] = $cadena;
 * 	}
 * 	public function getImagesCuratedAttribute() {
 * 		$result = array();
 * 		foreach($this->images as $image) {
 * 			$image->src = $cadena = str_replace('uploads/', '', $image->src);;
 * 			$result[] = $image;
 * 		}
 * 		return $result;
 * 	}
 * }
 */
class GalleryList extends Image
{
	protected $view = 'gallerylist';
	public function initialize()
	{
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/GalleryList.js'));
		AssetManager::addScript('admin::default/js/formitems/image/flow.min.js');
		AssetManager::addScript('admin::default/js/formitems/image/Sortable.min.js');
		AssetManager::addScript('admin::default/js/formitems/image/sortable.jquery.binding.js');
		AssetManager::addStyle('admin::default/css/formitems/image/images.css');
	}
	public function render () {
		$params = $this->getParams();
		// $tipo = typeof $params;
		// $values = [];
		// return var_dump($values);
		// return var_dump($params['value']);
		// $params['value'] = ;
		return view('an-admin::formitem.'.$this->view, $params)->render();
	}
	public function save()
	{
		// $name = $this->name();s
		// $value = Input::get($name, '');
		// throw new Exception(var_dump($value), 1);

		// if ( ! empty($value))
		// {
		// 	$value = explode(',', $value);
		// } else
		// {
		// 	$value = [];
		// }
		// Input::merge([$name => $value]);
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