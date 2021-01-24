<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';

    protected $fillable = [
    	'user_id', 'deliver', 'destination_city', 'origin_city', 'place_of_delivery', 'pick_up_place', 'type', 'status'
    ];

    public function delivery_detail()
    {
    	return $this->hasOne(Delivery_detail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'LIKE', "%$value%")
                     ->orWhere('user_id', 'LIKE', "%$value%")
                     ->orWhere('origin_city', 'LIKE', "%$value%")
                     ->orWhere('destination_city', 'LIKE', "%$value%");
    }
}
