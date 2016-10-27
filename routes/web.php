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

Auth::routes();

$this->group(['middleware' => ['auth']], function() {
    $this->get('/', function () {
        return view('index');
    });

    // Companies
    $this->resource('companies', 'CompanyController');
    $this->get('companies/{company}/add-user', ['as' => 'company.add_user_view', 'uses' => 'CompanyController@addUserView']);
    $this->post('companies/{company}/add-user', ['as' => 'company.add_user', 'uses' => 'CompanyController@addUser']);
    $this->get('companies/{company}/users', ['as' => 'companies.users', 'uses' => 'CompanyController@viewUsers']);
    $this->delete('companies/{company}/user/{user}/role/{role}/delete', ['as' => 'company.delete_users', 'uses' => 'CompanyController@deleteUser']);
    $this->get('companies/{company}/add-admin', 'CompanyController@addAdminView');
    $this->get('companies/{company}/admins', 'CompanyController@viewAdmins');
    $this->get('companies/{company}/events', 'CompanyController@viewEvents');
    $this->get('companies/{company}/add-media', 'CompanyController@addMediaView');
    $this->post('companies/{company}/add-media', 'CompanyController@addMedia');

    // Company Medias
    $this->resource('companies/{company}/medias', 'CompanyMediaController');

    // Company Products
    $this->resource('companies/{company}/products', 'ProductController');

    // Events
    $this->resource('events', 'EventController');
    $this->get('events/{event}/add-user', 'EventController@addUserView');
    $this->post('events/{event}/add-user', 'EventController@addUser');
    $this->get('events/{event}/users', 'EventController@viewUsers');
    $this->delete('events/{event}/user/{user}/role/{role}/delete', 'EventController@deleteUser');
    $this->get('events/{event}/add-company', 'EventController@addCompanyView');
    $this->post('events/{event}/add-company', 'EventController@addCompany');
    $this->get('events/{event}/companies', ['as' => 'events.companies', 'uses' => 'EventController@viewCompanies']);
    $this->delete('events/{event}/company/{company}/delete', ['as' => 'events.delete_company', 'uses' => 'EventController@deleteCompany']);
    $this->get('events/{event}/add-admin', 'EventController@addAdminView');
    $this->get('events/{event}/admins', 'EventController@viewAdmins');

    // Users
    $this->resource('users', 'UserController');

    // Ajax
    $this->get('user-autocomplete', 'UserController@userAutocomplete');

    $this->get('test', function() {
        $user = Auth::user();

        echo Storage::url('test.jpg');

        //echo json_encode($user->eventRoles);
    });
});

Route::get('403', function() {
    return view('errors.403');
});