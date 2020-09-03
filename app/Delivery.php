<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';

    protected $fillable = [
    	'user_id', 'deliver', 'destination_city', 'origin_city', 'shipping_ponti', 'pick_up_point', 'type', 'status'
    ];

    public function delivery_details()
    {
    	return $this->hasManny(Delivery_details::class);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'LIKE', "%$value%")
                     ->orWhere('user_id', 'LIKE', "%$value%");
    }
}
