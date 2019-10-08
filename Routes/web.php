<?php

Route::get('/home', function(){return redirect()->route('portal.dashboard');});
Route::get('/', function(){return redirect()->route('portal.dashboard');});

Route::get('/company', function(){return redirect()->route('portal.dashboard');});

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
	Route::get('/import/{event_validation}', 'ImportController@index')->name('portal.import');

	// validation
	Route::post('/validation/{event_validation}', 'ValidationController@index')->name('portal.validation');

	Route::post('/validation/{event_validation}/start', 'ValidationController@start')->name('portal.validation.start');
	Route::get('/validation/{event_validation}/info', 'ValidationController@info')->name('portal.validation.info');

	Route::post('/validation/{event_validation}/2', 'ValidationController@index2')->name('portal.validation2');
	Route::post('/validation/{event_validation}/start2', 'ValidationController@start2')->name('portal.validation.start2');
	Route::get('/validation/{event_validation}/info2', 'ValidationController@info2')->name('portal.validation.info2');
	Route::put('/validation/{event_validation}/clean', 'ValidationController@eventValidationClean')->name('portal.validation.clean');
	Route::get('/validation/{event_validation}/download/original', 'ValidationController@downloadOriginal')->name('portal.validation.download.original');
	Route::get('/validation/{event_validation}/download/debug', 'ValidationController@downloadDebug')->name('portal.validation.download.debug');
	Route::get('/validation/{event_validation}/download/clean', 'ValidationController@downloadClean')->name('portal.validation.download.clean');
	Route::post('/validation/{event_validation}/errors', 'ValidationController@errors')->name('portal.validation.errors');
	

	Route::get('/validation/{event_validation}/download', 'ValidationController@download')->name('portal.validation.download');

	//documentation
	Route::get('/doc/{event_validation}', 'DocController@index')->name('portal.doc');
	Route::get('/doc/{event_validation}/sample', 'DocController@downloadSample')->name('portal.doc.download.sample');
	Route::get('/doc/{validation}/download/pdf', 'DocController@downloadPDF')->name('portal.doc.download.pdf');


	// company
	Route::put('/company/{event_info}/{company_address}/update', 'CompanyController@updateCompanyInfoAddress')->name('portal.company.info.address.update');
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

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Company
	Route::get('/companies/{company}/{tab}', 'CompanyController@edit')->name('portal.companies.edit');
	Route::put('/companies/{company}', 'CompanyController@update')->name('portal.company.update');
	Route::put('/companies/{company_info}/info', 'CompanyController@updateInfo')->name('portal.company.update.info');
	Route::put('/companies/{company_address}/address', 'CompanyController@updateAddress')->name('portal.company.update.address');

	// Event
	Route::put('/events/parameterless/update', 'EventController@updateParameterless')->name('events.parameterless.update');

	// Imports
	Route::get('/imports', 'ImportsController@index')->name('portal.imports');

	
	Route::get('/imports/widget/{event_validation}/info', 'ImportsController@info')->name('imports.widget.info');

	Route::post('/imports/widget/{event_validation}/upload', 'ImportsController@upload')->name('imports.widget.upload');
	Route::post('/imports/widget/{event_validation}/errors', 'ImportsController@errors')->name('imports.widget.errors');
	Route::post('/imports/widget/{event_validation}/start', 'ImportsController@start')->name('imports.widget.start');

	Route::put('/imports/widget/{event_validation}/clean', 'ImportsController@clean')->name('imports.widget.clean');

	Route::get('/imports/widget/{event_validation}/download/original', 'ImportsController@downloadOriginal')->name('imports.widget.download.original');
	Route::get('/imports/widget/{event_validation}/download/debug', 'ImportsController@downloadDebug')->name('imports.widget.download.debug');

	// FAQ
	Route::get('/faq', 'FAQController@index')->name('company.faq');
	Route::get('/faq/{faq_topic}', 'FAQController@items')->name('company.faq.items');

});

