<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels';

    protected $fillable = [
        'user_id', 'origin', 'destination', 'vehicle_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'LIKE', "%$value%")
                     ->orWhere('user_id', 'LIKE', "%$value%")
                     ->orWhere('origin', 'LIKE', "%$value%")
                     ->orWhere('destination', 'LIKE', "%$value%");
    }
}
