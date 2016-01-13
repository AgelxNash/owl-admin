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
	protected $fields = array();
	public function initialize()
	{
		AssetManager::addScript(asset('packages/agelxnash/admin/js/helpers.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/GalleryList.js'));
		AssetManager::addScript('admin::default/js/formitems/image/flow.min.js');
		AssetManager::addScript('admin::default/js/formitems/image/Sortable.min.js');
		AssetManager::addScript('admin::default/js/formitems/image/sortable.jquery.binding.js');
		AssetManager::addStyle('admin::default/css/formitems/image/images.css');
		AssetManager::addStyle(asset('packages/agelxnash/admin/css/FormItems/GalleryList.css'));
	}
	public function render () {
		return view('an-admin::formitem.'.$this->view, $this->getParams())->render();
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