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

Route::get('/', 'WelcomeController@index');
Route::get('/home', 'HomeController@index');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Pacientes
Route::get('pacientes', ['as'=>'pacientes','uses'=>'PatientsController@index']);
Route::get('pacientes/registrar', ['as'=>'crear-pacientes','uses'=>'PatientsController@create']);
Route::post('pacientes/registrar', ['as'=>'guardar-pacientes','uses'=>'PatientsController@store']);
//Empresas
Route::get('empresas', ['as'=>'empresas','uses'=>'CompanyController@index']);
Route::get('empresas/registrar', ['as'=>'crear-empresa','uses'=>'CompanyController@create']);
Route::post('empresas/registrar', ['as'=>'guarda-empresa','uses'=>'CompanyController@store']);
Route::get('empresas/listado', ['as'=>'lista-empresas','uses'=>'CompanyController@companys_list']);
//Atenciones
Route::get('atenciones', ['as'=>'atenciones','uses'=>'AtentionController@index']);
Route::get('atenciones/registrar', ['as'=>'crear-atencion','uses'=>'AtentionController@create']);