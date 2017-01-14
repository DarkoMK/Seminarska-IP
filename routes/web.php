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

Route::post('/naredbi/nova', 'NaredbiController@vnesiNaredba');
Route::post('/naredbi/izbrisi', 'NaredbiController@izbrisiNaredba');
Route::post('/naredbi/edit', 'NaredbiController@editNaredba');

Route::post('/korisnik/promeniLozinka', 'UserController@promeniLozinka');

Route::get('/korisnici/UserGetAllKorisnici', 'KorisniciController@getUserKorisnici');
Route::get('/korisnici/UserExists/{kemail}', 'KorisniciController@UserExists');
Route::post('/korisnik/dodaj', 'KorisniciController@dodajKorisnik');
Route::post('/korisnik/izmeni', 'KorisniciController@izmeniKorisnik');
Route::post('/korisnik/izbrisi', 'KorisniciController@izbrisiKorisnik');
Route::get('/korisnici/UserGetKorisnik/{k_id}', 'KorisniciController@getUserKorisnik');