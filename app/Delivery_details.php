<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_details extends Model
{
	public $timestamps = false;
	protected $table = 'delivery_details';
	protected $fillable = [
		'delivery_id', 'size', 'hight', 'long', 'width', 'declared_value'
	];

    public function delivery_details()
    {
    	return $this->belongsTo(Delivery::class);
    }
}
