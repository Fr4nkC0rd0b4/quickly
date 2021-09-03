<?php

use App\Events\NotificationsPushEvent;
use Illuminate\Support\Facades\Route;
use App\Delivery;

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

Route::get('/test/pusher', function () {
	// dd(Delivery::find(56));
	event(new NotificationsPushEvent(Delivery::find(56)));
	return 'Fired';
});

//Rutas de consola de administración Voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes(['verify' => true]);

Route::get('/home/{any?}', 'HomeController@index')->name('home')->middleware('verified');

//Rutas de Perfil
Route::post('/account/profile/update', 'ProfileController@update')->name('profile.update');

Route::get('/account/profile/{id}', 'ProfileController@index');

//Cities and Departaments
Route::get('/helpers/cities', 'HelperController@cities')->name('cities.index')->middleware('auth');

//Vehicles
Route::get('/helpers/vehicles/{user}', 'HelperController@vehicles')->name('vehicles.index')->middleware('auth');

//Rutas de envios
Route::resource('/delivery', 'DeliveryController');

//Rutas de envios
Route::resource('/travel', 'TravelController');

//Rutas vue
Route::get('/spa/{any?}/{any1?}/{any2?}/{any13?}', function ($any) {
	return view('home');
})->where('spa', '.*')->name('rutas.vue')->middleware('auth', 'verified');

//Rutas para completar información del registro
Route::get('/test/{any?}/{any1?}', function ($any) {
	return view('auth.register-complete');
});