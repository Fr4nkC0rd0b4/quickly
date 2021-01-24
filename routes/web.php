<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas vue
Route::get('vue/{any?}/{any1?}',function($any){
	return view('home');
})->where('vue', '.*')->name('rutas.vue')->middleware('auth');

//Rutas de Perfil
Route::post('/account/profile/update', 'ProfileController@update')->name('profile.update');

Route::get('/account/profile/{id}', 'ProfileController@index');

//Rutas de envios
Route::resource('/delivery', 'DeliveryController');

//Rutas de consola de administración Voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
