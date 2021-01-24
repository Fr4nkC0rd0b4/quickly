<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_detail extends Model
{
	public $timestamps = false;
	protected $table = 'delivery_details';
	protected $fillable = [
		'delivery_id', 'size', 'hight', 'long', 'width', 'initial_offer', 'final_offer'
	];

    public function delivery_detail()
    {
    	return $this->belongsTo(Delivery::class);
    }
}
