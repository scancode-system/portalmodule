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
	Route::get('/company', 'DashboardController@index')->name('portal.dashboard');

	// main
	Route::get('/main/{tab}', 'MainController@index')->name('portal.main');

	// import
	Route::get('/import/{company_validation}', 'ImportController@index')->name('portal.import');

	// validation
	Route::post('/validation/{company_validation}', 'ValidationController@index')->name('portal.validation');

	Route::post('/validation/{company_validation}/start', 'ValidationController@start')->name('portal.validation.start');
	Route::get('/validation/{company_validation}/info', 'ValidationController@info')->name('portal.validation.info');
	Route::get('/validation/{company_validation}/download', 'ValidationController@download')->name('portal.validation.download');

	//documentation
	Route::get('/doc/{company_validation}', 'DocController@index')->name('portal.doc');
	Route::get('/doc/{company_validation}/sample', 'DocController@downloadSample')->name('portal.doc.download.sample');
	Route::get('/doc/{validation}/download/pdf', 'DocController@downloadPDF')->name('portal.doc.download.pdf');


	// company
	Route::put('/company/{company_info}/{company_address}/update', 'CompanyController@updateCompanyInfoAddress')->name('portal.company.info.address.update');
	// setting
	Route::put('/setting/{system_setting}/update', 'SystemSettingController@update')->name('portal.system_setting.update');


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

