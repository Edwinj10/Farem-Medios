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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'FrontController@index');
Route::resource('/usuarios', 'UsuarioController');
Route::get('/listall/{page?}', 'UsuarioController@listall');
Route::resource('/medios', 'MediosController');
Route::get('/listallmedios/{page?}', 'MediosController@listall');
Route::resource('/ingresos', 'IngresoController');
Route::get('/listallingresos/{page?}', 'IngresoController@listar');

//index

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
