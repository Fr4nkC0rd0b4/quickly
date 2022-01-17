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
    public function time()
    {
        $time = 'Hace';

        $date = Carbon::parse($this->created_at);

        $now = Carbon::now();

        $diff = $date->diff($now);

        if ($diff->i <= 60) {
            $time .= " $diff->i minuto(s)";
        } else if ($diff->h <= 24) {
            $time .= " $diff->h hora(s)";
        } else {
            $time .= " $diff->days día(s)";
        }

        return $time;
    }

    public function date()
    {
        $date = Carbon::parse($this->created_at)->locale('es');

        $date = $date->format('j F Y h:i a');

        return $date;
    }
}
