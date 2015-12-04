<?php namespace AgelxNash\Admin\Display;

use SleepingOwl\Admin\Display\DisplayDatatablesAsync;
use Input;

class DatatablesSearchAsync extends DisplayDatatablesAsync{

	protected $searchColumns = [];
	public function setSearchColumns($columns = []){
		$this->searchColumns = $columns;
		return $this;
	}
	protected function applySearch($query)
	{
		$search = trim(Input::get('search.value'));
		if (empty($search) && $search !== '0'){
			return;
		}
		if(is_array($this->searchColumns)) {
			$query->where(function ($query) use ($search) {
				foreach ($this->searchColumns as $column) {
					if ($this->repository->hasColumn($column)) {
						$query->orWhere($column, 'like', '%' . $search . '%');
					}
				}
			});
		}
	}
}