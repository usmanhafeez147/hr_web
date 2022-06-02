<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test',function(){
	return view('guest.pages.after_registered');
});

Route::get('/', 'HomeController@index')->name('home');


//register a company

Route::get('/subscribe/{slug}-{id}','CompanyController@subscribe')->name('subscribe')->where('slug', '([0-9A-Za-z\-]+)')->where('id', '([0-9]+)');


Route::post('/company/register','CompanyController@register')->name('com_register');
//verification for company
Route::get('/verify/{company_id}','CompanyController@verification')->name('verify');

//company location
Route::post('/verify','CompanyController@verifyWizard')->name('location_save');
//
// Route::get('/adduser/{token}/{cid}','CompanyController@addUser')->name('adduser');

// Route::post('/invite/{token}','CompanyController@invite')->name('invite');

// Route::post('/requirements','CompanyController@requirements')->name('requirements');



Auth::routes();

///ADMIN PANNEL
//login OR adminHome
Route::group(['prefix'=>'/admin','middleware'=>'auth'],function(){
	Route::get('/','AdminController@index')->name('myhome');
	
	//employeeslisting

	Route::get('/employee','Admin\EmployeeController@index')->name('employees');
		
	//store employee
	Route::post('/employee/store','Admin\EmployeeController@store')->name('create');

	//update employee
	Route::post('/employee/update','Admin\EmployeeController@update')->name('edit');

	// re-Invite
	Route::post('/employee/reinvite','Admin\EmployeeController@reinvite');


	Route::get('/location','Admin\LocationController@index')->name('location');

	Route::post('/location/store','Admin\LocationController@store')->name('location.create');

	Route::post('/location/update','Admin\LocationController@update')->name('locaiton.edit');

	Route::get('/location/delete/{id}','Admin\LocationController@destroy')->name('delete_location');

	//Delete
	Route::get('/employee/delete/{id}','Admin\EmployeeController@destroy')->name('delete_employee');

});



Route::get('/admin/check/{checkId}','AdminController@approve')->name('approve')->middleware('auth');


//get Checks

Route::get('/employee/{uid}','AdminController@checks')->name('checks')->middleware('auth');


//late commers
Route::get('/employees/latecommers','AdminController@latecommers')->name('latecommers');
//earlygoers
Route::get('/employees/earlygoers','AdminController@earlygoers')->name('earlygoers');

Route::get('/employees/leave/{uid}/{days}','AdminController@leaves')->name('leave');

