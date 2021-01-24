<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    protected $table = 'payment_methods';
    protected $fillable = [
    	'user_id', 'name_owner', 'last_name_owner', 'card_type', 'card_number', 'expiration_month', 'expiration_year'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
