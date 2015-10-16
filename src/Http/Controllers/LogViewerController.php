<?php namespace AgelxNash\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use Admin;
use SleepingOwl\Admin\AssetManager\AssetManager;

class LogViewerController extends Controller {
	public function getIndex(){
		AssetManager::addScript('admin::default/js/datatables/jquery.dataTables.min.js');
		AssetManager::addScript('admin::default/js/datatables/jquery.dataTables_bootstrap.js');
		AssetManager::addScript('admin::default/js/notify-combined.min.js');

		AssetManager::addStyle('admin::default/css/dataTables.bootstrap.css');

		if (Input::get('l')) {
			LaravelLogViewer::setFile(base64_decode(Input::get('l')));
		}

		if (Input::get('dl')) {
			return Response::download(storage_path() . '/logs/' . base64_decode(Input::get('dl')));
		} elseif (Input::has('del')) {
			File::delete(storage_path() . '/logs/' . base64_decode(Input::get('del')));
			return Redirect::to(Request::url());
		}

		$logs = LaravelLogViewer::all();
		$view = View::make('an-admin::page.log-viewer', [
			'logs' => $logs,
			'files' => LaravelLogViewer::getFiles(true),
			'current_file' => LaravelLogViewer::getFileName()
		]);

		return Admin::view($view, trans('an-admin::lang.log-viewer.title'));
	}
}