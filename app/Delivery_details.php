<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_details extends Model
{
    public function delivery_details()
    {
    	return $this->belongsTo(Delivery::class);
    }
}
