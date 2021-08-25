<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Delivery;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Rutas de Autenticación
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@loginApi');

//Rutas de pruebas
Route::get('/deliveries', function (Request $request)
{
	$deliveries = Delivery::search($request->searching)->orderBy('id', 'DESC')->get();

	 foreach ($deliveries as $key => $value) {
        $value->detail;
        $value->user;
    }

    return response()->json($deliveries);
});
