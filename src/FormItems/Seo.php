<?php namespace AgelxNash\Admin\FormItems;

use Illuminate\Database\Eloquent\Model;
use Input;
use Request;
use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use AgelxNash\SEOTools\Models\Seo as SeoModel;
use AgelxNash\SEOTools\Models\Keyword as KeywordModel;
use AgelxNash\SEOTools\Interfaces\SeoInterface;
use \SleepingOwl\Admin\FormItems\BaseFormItem;

Class Seo extends BaseFormItem{
	protected $view = 'seo';
	/**
	 * @var SeoModel
	 */
	protected $seoModel;
	/**
	 * @var KeywordModel
	 */
	protected $keyModel;

	public function __construct(SeoModel $seoModel, KeywordModel $keyModel){
		$this->seoModel = $seoModel;
		$this->keyModel = $keyModel;
	}

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
	public function getFiels(){
		$values = new Collection;
		foreach($this->seoModel->getFillable() as $fill){
			if(!in_array($fill, ['document_id', 'document_type'])){
				$values->offsetSet($fill, null);
			}
		}
		return $values;
	}
	public function getDefault(){
		$instance = $this->instance();
		return new Collection((is_null($instance) || !$instance instanceof SeoInterface) ? [] : $instance->getDefaultSeoFields());
	}
	/**
	 * @return Collection
	 */
	public function values()
	{
		$instance = $this->instance();
		$values = $this->getFiels();
		$default = $this->getDefault();
		$request = Request::old('seo', []);
		$input = get_key(Input::all(), 'seo', [], 'is_array');
		$options = $this->options();

        foreach($values as $key => $val){
            $val = $default->get($key);
            switch(true){
                case is_null($val) && array_key_exists($key, $request):{
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
				case array_key_exists($key, $input):{
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

			$keys = array_diff(array_map('trim', $keys), array('', 0, null));

			foreach ($keys as &$key) {
				$key = $this->keyModel->firstOrCreate(['name' => $key])->getKey();
			}
			$values->offsetSet('keywords', $keys);
			$values->offsetSet('priority', str_replace(",", ".", $values->get('priority')));
			$this->instance()->seo = $values->toArray();
			$seo = $this->instance()->seo()->first();
			if($seo instanceof Model) {
				$seo->save();
			}
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
