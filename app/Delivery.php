<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';

    protected $fillable = [
    	'user_id', 'deliver', 'origin', 'destination', 'pick_up_point', 'delivery_point', 'type', 'status'
    ];

    public function detail()
    {
    	return $this->hasOne(DeliveryDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'LIKE', "%$value%")
                     ->orWhere('user_id', 'LIKE', "%$value%")
                     ->orWhere('origin', 'LIKE', "%$value%")
                     ->orWhere('destination', 'LIKE', "%$value%");
    }
}
