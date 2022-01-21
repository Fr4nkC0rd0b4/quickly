<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['notifiable_type', 'type',];

    /**
     * Devuelve hace cuanto tiempo llegó la notificación
     * @return String $time
     */
    public function time($created_at)
    {
        $time = 'Hace';

        $date = Carbon::parse($created_at);

        $now = Carbon::now();

        $diff = $date->diff($now);

        if ($diff->i <= 60 && $diff->h == 0 && $diff->days == 0) {
            $time .= " $diff->i minuto(s)";
        } else if ($diff->h <= 24 && $diff->days == 0) {
            $time .= " $diff->h hora(s)";
        } else {
            $time .= " $diff->days día(s)";
        }

        return $time;
    }

    public function date($created_at)
    {
        $date = Carbon::parse($created_at)->locale('es');

        $date = $date->format('j F Y h:i a');

        return $date;
    }
}
