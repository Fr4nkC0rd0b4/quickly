<?php

namespace App\Http\Controllers;

use App\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
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
        $notifications = Notification::whereJsonContains('data', ['user_id' => $id])->orderBy('created_at', 'DESC')->paginate(15);

        // Se cuentan las notificaciones no leídas
        $not_reads = count(Notification::whereJsonContains('data', ['user_id' => $id])->where('read_at', null)->get());

        foreach ($notifications as $value) {

            // Se agrega el elemento time, que almacena hace cuanto se recibió la notificación
            $value->time = $value->time();

            // Se agrega el elemento date, que almacena la fecha en formato de letras
            $value->date = $value->date();
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
     * @return Bool
     */
    public function markAsRead($id = null)
    {
        // Se obtiene el ID del usuario logueado
        $user_id = Auth::user()->id;

        // Current DateTime
        $now = Carbon::now();

        // Se valida si se existe el parametro $id
        if ($id) {

            // Si existe, se obtiene la notificación y se actualiza el registro
            $notification = Notification::find($id);

            $notification->read_at = $now;

            $notification->save();
        } else {

            // Sino se obtienen todas las notificaciones no leídas
            $notifications = Notification::whereJsonContains('data', ['user_id' => $user_id])->where('read_at', null)->get();

            foreach ($notifications as $value) {

                // Se establece la fecha de lectura
                $value->read_at = $now;

                // Se actualiza el registro
                $value->save();
            }
        }

        return response()->json(['done'], 200);
    }
}