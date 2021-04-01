<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'user_locations';
    protected $fillable = [
    	'user_id', 'country', 'state', 'city', 'address', 'neighborhood', 'is_main'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
