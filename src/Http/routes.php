<?php

Route::group([
	'prefix'    => config('admin.prefix'),
	'middleware' => config('admin.middleware'),
	'namespace' => 'AgelxNash\Admin\Http\Controllers',
], function ()
{
	Route::get('log-viewer',[
		'as'   => 'admin.log-viewer',
		'uses' => 'LogViewerController@getIndex'
	]);

	Route::get('server', [
		'as'   => 'admin.server',
		'uses' => 'ServerController@getIndex'
	]);
});