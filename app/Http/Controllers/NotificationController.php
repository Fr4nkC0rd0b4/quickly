<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Notification;
use App\Traits\NotificationTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use NotificationTrait;

    public function test()
    {
        $delivery = Delivery::inRandomOrder()->first();

        $description = ' ha ofertado llevar su orden de envío.';

        $this->sendNotification($delivery, $description);
    }

    /**
     * Get all notifications for specific user
     * @return JSON $response
     */
    public function get()
    {
        // Se obtiene el ID del usuario logueado
        $id = Auth::user()->id;

        $not_reads = 0;

        // Se obtienen las notificaciones correspondientes a un usuario según el ID
        $notifications = Notification::whereJsonContains('data', ['receipter_id' => $id])->orderBy('created_at', 'DESC')->paginate(15);

        // Se cuentan las notificaciones no leídas
        $not_reads = count(Notification::whereJsonContains('data', ['receipter_id' => $id])->where('read_at', null)->get());

        foreach ($notifications as $value) {

            // Se agrega el elemento time, que almacena hace cuanto se recibió la notificación
            $value->time = $value->time($value->created_at);

            // Se agrega el elemento date, que almacena la fecha en formato de letras
            $value->date = $value->date($value->created_at);
        }

        $response = [
            'notifications' => $notifications,
            'not_reads' => $not_reads
        ];

        return response()->json($response, 200);
    }

    /**
     * Mark notification as read
     * @param String $id default null
     * @return JSON $response
     */
    public function markAsRead($id = null)
    {
        $response = [];

        // Se obtiene el ID del usuario logueado
        $user_id = Auth::user()->id;

        // Current DateTime
        $now = Carbon::now();

        // Se valida si se existe el parametro $id
        if ($id) {

            // Si existe, se obtiene la notificación y se actualiza el registro
            $notification = Notification::where('id', $id)->where('read_at', null)->first();

            if ($notification) {

                $notification->read_at = $now;

                $notification->save();

                $response = [
                    'status' => 'success',
                    'counter' => 1
                ];
            } else {
                $response = [
                    'status' => 'info',
                    'counter' => 0
                ];
            }
        } else {

            // Sino se obtienen todas las notificaciones no leídas
            $notifications = Notification::whereJsonContains('data', ['receipter_id' => $user_id])->where('read_at', null)->get();

            foreach ($notifications as $value) {

                // Se establece la fecha de lectura
                $value->read_at = $now;

                // Se actualiza el registro
                $value->save();
            }

            $response = [
                'status' => 'success',
                'counter' => count($notifications)
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $id
     * @return JSON
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);

        $notification->delete();

        return response()->json(['message' => 'deleted'], 200);
    }
}
