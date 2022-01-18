<?php

use App\Events\NotificationsPushEvent;
use Illuminate\Support\Facades\Route;
use App\Delivery;
use App\User;
use App\Notification as NotificationModel;
use App\Notifications\EventNotifications;
use Illuminate\Support\Facades\Notification;

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
Route::resource('/delivery', 'DeliveryController');

//Rutas de viajes
Route::resource('/travel', 'TravelController');

// Rutas de notificaciones
Route::prefix('notifications')->group(function () {

	// Obtener notificaciones de un usuario en especifico
	Route::get('get', 'NotificationController@get');

	// Marcar como leídas
	Route::get('mark-as-read/{any?}', 'NotificationController@markAsRead');
});

//Rutas vue
Route::get('/spa/{any?}/{any1?}/{any2?}/{any13?}', function ($any) {
	return view('home');
})->where('spa', '.*')->name('rutas.vue')->middleware('auth', 'verified');

Route::get('/test/pusher', function () {
	$delivery = Delivery::find(45);

	$notification = [
		'title'     		=> $delivery->user->name,
		'description' 		=> ' ha aceptado hacer tu entrega.',
		'user_id'   		=> $delivery->user_id,
		'quickero_id'   	=> $delivery->user->id,
		'quickero_avatar' 	=> $delivery->user->avatar
	];

	Notification::send($delivery, new EventNotifications($notification));

	event(new NotificationsPushEvent('b24d38aa-dbb5-4600-8f3c-3cd2483da000'));
	return 'Fired';
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

//Rutas para completar información del registro
/* Route::get('/test/{any?}/{any1?}', function ($any) {
	return view('auth.register-complete');
}); */