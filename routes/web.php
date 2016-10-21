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

Route::group(['middleware' => ['web']], function () {
    Auth::routes();

    $this->group(['middleware' => ['auth']], function() {
        $this->get('/', function () {
            return view('index');
        });

        // Companies
        $this->resource('companies', 'CompanyController');
        $this->get('companies/{company}/add-user', 'CompanyController@addUserView');
        $this->post('companies/{company}/add-user', 'CompanyController@addUser');
        $this->get('companies/{company}/users', 'CompanyController@viewUsers');
        $this->delete('companies/{company}/user/{user}/role/{role}/delete', 'CompanyController@deleteUser');

        // Events
        $this->resource('events', 'EventController');
        $this->get('events/{event}/add-user', 'EventController@addUserView');
        $this->post('events/{event}/add-user', 'EventController@addUser');
        $this->get('events/{event}/users', 'EventController@viewUsers');
        $this->delete('events/{event}/user/{user}/role/{role}/delete', 'EventController@deleteUser');
        $this->get('events/{event}/add-company', 'EventController@addCompanyView');
        $this->post('events/{event}/add-company', 'EventController@addCompany');
        $this->get('events/{event}/companies', 'EventController@viewCompanies');
        $this->delete('events/{event}/company/{company}/delete', 'EventController@deleteCompany');

        // Users
        $this->resource('users', 'UserController');

        // Ajax
        $this->get('user-autocomplete', 'UserController@userAutocomplete');
    });
});

Route::get('/home', 'HomeController@index');
