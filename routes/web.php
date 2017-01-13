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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/pocetna', 'PocetnaController@index');
Route::get('/naredbi', 'NaredbiController@index');
Route::get('/pomos', 'PomosController@index');
Route::get('/podesuvanja', 'PodesuvanjaController@index');
Route::get('/korisnici', 'KorisniciController@index');
Route::get('/kukji', 'KukjiController@index');

Route::get('/naredbi/ured/vklucen/{id_ured}', 'NaredbiController@getUredStatusVK');
Route::get('/naredbi/ured/isklucen/{id_ured}', 'NaredbiController@getUredStatusISK');

Route::post('/naredbi/ured/vkluci', 'NaredbiController@vkluciUred');
Route::post('/naredbi/ured/iskluci', 'NaredbiController@iskluciUred');

Route::get('/naredbi/UserGetAllNaredbi', 'NaredbiController@getUserNaredbi');
Route::get('/naredbi/UserGetAllUredi', 'NaredbiController@getUserUredi');
Route::get('/naredbi/getServerTime', 'NaredbiController@getServerTime');