<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('test', function () {
    return view('index2');
});

// Companies
Route::resource('companies', 'CompanyController');
Route::get('companies/{company}/add-user', 'CompanyController@addUserView');
Route::post('companies/{company}/add-user', 'CompanyController@addUser');
Route::get('companies/{company}/users', 'CompanyController@viewUsers');
Route::delete('companies/{company}/user/{user}/role/{role}/delete', 'CompanyController@deleteUser');

// Events
Route::resource('events', 'EventController');
Route::get('events/{event}/add-user', 'EventController@addUserView');
Route::post('events/{event}/add-user', 'EventController@addUser');
Route::get('events/{event}/users', 'EventController@viewUsers');
Route::delete('events/{event}/user/{user}/role/{role}/delete', 'EventController@deleteUser');
Route::get('events/{event}/add-company', 'EventController@addCompanyView');
Route::post('events/{event}/add-company', 'EventController@addCompany');
Route::get('events/{event}/companies', 'EventController@viewCompanies');
Route::delete('events/{event}/company/{company}/delete', 'EventController@deleteCompany');

// Users
Route::resource('users', 'UserController');

// Ajax
Route::get('user-autocomplete', 'UserController@userAutocomplete');
Auth::routes();

Route::get('/home', 'HomeController@index');
