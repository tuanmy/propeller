<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/test',function(){
// 	return View::make('pragmarx/ci::dashboard');
// });

Route::get('/', 'HomeController@index');
Route::get('/termsofuse', function(){
	return view('termsofuse');
});

Route::get('/home','HomeController@index');

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

//Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');



Route::post('user/checkexistusername',array(
	'as' 	=>'user.checkexistusername',
	'uses' 	=>'UserController@checkExistUsername'
));

Route::post('user/checkexistemail',array(
	'as' 	=>'user.checkexistemail',
	'uses' 	=>'UserController@checkExistEmail'
));

Route::post('user/checkexistusernameignore',array(
	'as' 	=>'user.checkexistusernameignore',
	'uses' 	=>'UserController@checkExistUsernameIgnore'
));

Route::post('user/checkeuEditProfile',array(
	'as' 	=>'user.checkeuEditProfile',
	'uses' 	=>'UserController@checkeuEditProfile'
));

Route::get('register/active/{active_code}',array(
	'as' 	=>'user.active',
	'uses' 	=>'UserController@active'
));

Route::get('register/resendemail/{email}',array(
	'as' 	=>'user.resendemail',
	'uses' 	=>'UserController@resendemail'
));

Route::get('register/resendemail/{email}',array(
	'as' 	=>'user.resendemail',
	'uses' 	=>'UserController@resendemail'
));

Route::get('auth/verify',array(
	'as' 	=>'auth.verify',
	'uses' 	=> function(){
		return view('auth.verify');
	}
));

Route::get('auth/block',array(
	'as' 	=>'auth.block',
	'uses' 	=> function(){
		return view('auth.block');
	}
));

Route::controllers([
    //'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function() {

	Route::get('person/create', array(
		'as' =>'person.create',
		'uses' =>'PersonController@getCreate'
	));

	Route::post('person/create', array(
		'as' =>'person.create',
		'uses' =>'PersonController@postCreate'
	));

	Route::get('user/create', array(
		'as' =>'user.create',
		'uses' =>'UserController@getCreate'
	));

	Route::post('user/create', array(
		'as' =>'user.create',
		'uses' =>'UserController@postCreate'
	));

	Route::post('user/getInfoUser', array(
		'as' =>'user.getInfoUser',
		'uses' =>'UserController@getInfoUser'
	));

	Route::post('user/addUserExist', array(
		'as' =>'user.addUserExist',
		'uses' =>'UserController@addUserExist'
	));

	Route::get('user/profile/{id}', array(
		'as' =>'user.getProfile',
		'uses' =>'UserController@getprofile'
	));

	Route::post('user/profile/{id}', array(
		'as' =>'user.postProfile',
		'uses' =>'UserController@postProfile'
	));

	Route::get('user/editprofile/{id}', array(
		'as' =>'user.getEditProfile',
		'uses' =>'UserController@getEditProfile'
	));

	Route::post('user/editprofile/{id}', array(
		'as' =>'user.postEditProfile',
		'uses' =>'UserController@postEditProfile'
	));

	Route::get('user/usersametanent', array(
		'as' =>'user.getUserSameTenant',
		'uses' =>'UserController@getUserSameTenant'
	));

	Route::post('home/changeTenant', array(
		'as' =>'home.changeTenant',
		'uses' =>'HomeController@changeTenant'
	));
});