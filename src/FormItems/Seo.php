<?php namespace AgelxNash\Admin\FormItems;

use Input;
use Request;
use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use App\Models\Seo as SeoModel;
use App\Models\Keyword as KeywordModel;

Class Seo extends \SleepingOwl\Admin\FormItems\BaseFormItem{
	protected $view = 'seo';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/css/formitems/select/chosen.css');
		AssetManager::addScript('admin::default/js/formitems/select/chosen.jquery.min.js');
		AssetManager::addScript('admin::default/js/formitems/select/init.js');
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/select.js'));
		AssetManager::addScript(asset('packages/agelxnash/admin/js/FormItems/seo.js'));
	}

	public function getParams()
	{
		return parent::getParams() + [
			'value'     => $this->values(),
			'options' 	=> $this->options()
		];
	}
	public function options(){
		$options = [
			'robots' => ['index,follow','noindex,follow','index,nofollow','noindex,nofollow'],
			'state' => ['dynamic', 'static'],
			'priority' => for_all(range(0.1, 0.9, 0.1), function($item){
				return str_replace(".", ",", $item);
			}),
			'frequency' => ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never']
		];
		$out = new Collection();
		foreach($options as $attr => $values){
			$out->offsetSet($attr, array_copy_key($values));
		}
		return $out;
	}

	/**
	 * @return Collection
	 */
	public function values()
	{
		$values = new Collection([
			'title' => null,
			'description' => null,
			'robots' => null,//index,follow',
			'state' => null,//'dynamic',
			'priority' => null,//'0.5',
			'frequency' => null,//'daily',
			'keywords' => null,
			'h1' => null
		]);
		$default = new Collection([
			'robots' => 'index,follow',
			'state' => 'dynamic',
			'priority' => '0,5',
			'frequency' => 'daily'
		]);
		$instance = $this->instance();
		$request = Request::old('seo', []);
		$input = get_key(Input::all(), 'seo', [], 'is_array');
		$options = $this->options();

		foreach($values as $key => $val){
			$values->offsetSet($key, $default->get($key));
			switch(true){
				case array_key_exists($key, $request):{
					$val = get_key($request, $key, '', function($val) use($options, $key){
						$out = true;
						if($options->offsetExists($key)){
							$opt = $options->get($key);
							if(is_array($opt) && !in_array($val, $opt)) {
								$out = false;
							}
						}
						return $out;
					});
					break;
				}
				case (is_null($val) && array_key_exists($key, $input)):{
					$val = get_key($input, $key, '', function($val) use($options, $key){
						$out = true;
						if($options->offsetExists($key)){
							$opt = $options->get($key);
							if(is_array($opt) && !in_array($val, $opt)) {
								$out = false;
							}
						}
						return $out;
					});
					break;
				}
				case (is_null($val) && !is_null($instance) && !is_null($instance->seo) && !is_null($instance->seo->$key)): {
					$val = $instance->seo->$key;
					if($val instanceof \Illuminate\Database\Eloquent\Collection){
						$val = $val->implode('name', ',');
					}
					break;
				}
			}
			$values->offsetSet($key, $val);
		}
		return $values;
	}

	public function save(){
		$values = $this->values();
		if ($this->instance()->exists()) {
			$keys = $values->get('keywords');
			$keys = (is_scalar($keys)) ? explode(',', $keys) : $keys;
			$keys = is_array($keys) ? $keys : [];
			$keys = array_clean(array_map('trim', $keys), array('', 0, null));

			//$values->forget('keywords');
			foreach ($keys as &$key) {
				$key = \App\Models\Keyword::firstOrCreate(['name' => $key])->getKey();
			}
			$values->offsetSet('keywords', $keys);
			$values->offsetSet('priority', str_replace(",", ".", $values->offsetGet('priority')));
			$this->instance()->seo = $values->toArray();
		}
	}

	public function render()
	{
		$params = $this->getParams();

		return view('an-admin::formitem.' . $this->view, $params)->render();
	}

	public function getValidationRules()
	{
		$rule = 'seo_keywords';
		if ($this->instance()->exists() && $this->instance()->seo()->exists()){
			$rule .= ':' . $this->instance()->seo->getKey();
		}

		return [
			'seo.keywords' => $rule
		];
	}
}