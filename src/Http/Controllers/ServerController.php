<?php namespace AgelxNash\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Admin, ezcSystemInfo, DB, Input;
use SleepingOwl\Admin\AssetManager\AssetManager;

class ServerController extends Controller {
	public function getIndex(){
		AssetManager::addScript('admin::default/js/datatables/jquery.dataTables.min.js');
		AssetManager::addScript('admin::default/js/datatables/jquery.dataTables_bootstrap.js');
		AssetManager::addScript('admin::default/js/notify-combined.min.js');
		AssetManager::addScript('admin::default/js/datatables/init.js');

		AssetManager::addStyle('admin::default/css/dataTables.bootstrap.css');

		switch(Input::get('method')){
			case 'phpinfo':{
				ob_start();
				phpinfo();
				$phpinfo = ob_get_contents();
				ob_get_clean();
				return $phpinfo;
			}
			default:{
			$view = View::make('admin::page.server', [
				'ezc' => ezcSystemInfo::getInstance(),
				'tableStatus' => DB::select(
					"SHOW TABLE STATUS FROM `".config('database.connections.mysql.database')."` LIKE '".config('database.connections.mysql.prefix')."%'"
				)
			]);
			return Admin::view($view, trans('an-admin::lang.server.title'));
			}
		}
	}
}