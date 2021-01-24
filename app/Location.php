<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations_user';
    protected $fillable = [
    	'user_id', 'country', 'state', 'city', 'address', 'neighborhood', 'is_main'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
