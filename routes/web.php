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
Route::resource('/periodos', 'PeriodoController');
Route::resource('/reservaciones', 'ReservacionController');
Route::get('/listallingresos/{page?}', 'IngresoController@listar');
Route::get('/listallreservacion/{page?}', 'ReservacionController@listar');
Route::get('/list_fechas/{fecha}', 'ReservacionController@list_fechas');
Route::get('/list_fechas2/{fecha}/{page?}', 'ReservacionController@list_fechas2');
Route::get('/list_fechas3/{fecha}/{page?}', 'ReservacionController@list_fechas3');
Route::get('/listallreservacion2/{page?}', 'ReservacionController@listar2');
Route::get('/reservaciones2', 'ReservacionController@index2');
Route::get('/listP/{page?}', 'PeriodoController@listall');
Route::get('/medios2', 'MediosController@index2');
Route::get('/list_depto/{depto}/{page?}', 'MediosController@listall2');
Route::get('/list_depto2/{depto}/{nombre}/{page?}', 'MediosController@listall3');
Route::get('/list_fecha/{medio}/{fecha}/{page?}', 'ReservacionController@mostrar');



//index

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
