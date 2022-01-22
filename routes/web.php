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

//Rutas de consola de administración Voyager
Route::group(['prefix' => 'admin'], function () {
	Voyager::routes();
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//Rutas de Perfil
Route::post('/account/profile/update', 'ProfileController@update')->name('profile.update');

Route::get('/account/profile/{id}', 'ProfileController@index');

//Cities and Departaments
Route::get('/helpers/cities', 'HelperController@cities')->name('cities.index')->middleware('auth');

//Vehicles
Route::get('/helpers/vehicles/{user}', 'HelperController@vehicles')->name('vehicles.index')->middleware('auth');

//Rutas de envios
Route::put('/delivery/offer-shipping-rate', 'DeliveryController@offerShippingRate');
Route::put('decline-shipping-rate', 'DeliveryController@declineShippingRate');
Route::resource('/delivery', 'DeliveryController');

//Rutas de viajes
Route::resource('/travel', 'TravelController');

// Rutas de notificaciones
Route::prefix('notifications')->group(function () {

	// Test envio de notificaciones
	Route::get('test', 'NotificationController@test');

	// Obtener notificaciones de un usuario en especifico
	Route::get('get', 'NotificationController@get');

	// Marcar como leídas
	Route::get('mark-as-read/{any?}', 'NotificationController@markAsRead');

	// Eliminar
	Route::delete('delete/{id}', 'NotificationController@destroy');
});

//Rutas vue
Route::get('/spa/{any?}/{any1?}/{any2?}/{any13?}', function ($any) {
	return view('home');
})->where('spa', '.*')->name('rutas.vue')->middleware('auth', 'verified');

// Log viewer
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

//Rutas para completar información del registro
/* Route::get('/test/{any?}/{any1?}', function ($any) {
	return view('auth.register-complete');
}); */