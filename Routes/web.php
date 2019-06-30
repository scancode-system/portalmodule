<?php

Route::get('/home', function(){return redirect()->route('portal.dashboard');});
Route::get('/', function(){return redirect()->route('portal.dashboard');});

Route::prefix('portal')->group(function() {

	// Auth
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register');


	// home
	Route::get('/home', function(){return redirect()->route('portal.dashboard');});
	Route::get('/', function(){return redirect()->route('portal.dashboard');}); 

	// dasboard
	Route::get('/client', 'DashboardController@index')->name('portal.dashboard');

	// main
	Route::get('/main/{tab}', 'MainController@index')->name('portal.main');

	// import
	Route::get('/import/{client_validation}', 'ImportController@index')->name('portal.import');

	// validation
	Route::post('/validation/{client_validation}', 'ValidationController@index')->name('portal.validation');

	Route::post('/validation/{client_validation}/start', 'ValidationController@start')->name('portal.validation.start');
	Route::get('/validation/{client_validation}/info', 'ValidationController@info')->name('portal.validation.info');
	Route::get('/validation/{client_validation}/download', 'ValidationController@download')->name('portal.validation.download');

	//documentation
	Route::get('/doc/{client_validation}', 'DocController@index')->name('portal.doc');
	Route::get('/doc/{client_validation}/sample', 'DocController@downloadSample')->name('portal.doc.download.sample');
	Route::get('/doc/{validation}/download/pdf', 'DocController@downloadPDF')->name('portal.doc.download.pdf');


	// company
	Route::put('/company/{company_info}/{company_address}/update', 'CompanyController@update')->name('portal.company.update');
	// setting
	Route::put('/setting/{system_setting}/update', 'SystemSettingController@update')->name('portal.client_setting.update');


	//documentations
	Route::get('/documentations', 'DocumentationController@index')->name('portal.documentations');

	//videos
	Route::get('/videos', 'VideoController@index')->name('portal.videos');

	//integrations
	Route::get('/integrations', 'IntegrationController@index')->name('portal.integrations');

	//images
	Route::post('/images/produtos', 'ImageController@produtos')->name('portal.images.produtos');
	Route::post('/images/logo', 'ImageController@logo')->name('portal.images.logo');
	Route::get('/images/show/{image_name}', 'ImageController@show')->name('portal.images.show');
	Route::get('/images/logo', 'ImageController@showLogo')->name('portal.images.logo');
	Route::delete('/images/produtos', 'ImageController@destroy')->name('portal.images.destroy');
	Route::delete('/images/logo', 'ImageController@destroyLogo')->name('portal.images.destroy.logo');


});

