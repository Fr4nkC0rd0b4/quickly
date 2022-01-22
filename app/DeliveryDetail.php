<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
	public $timestamps = false;
	protected $table = 'delivery_details';
	protected $fillable = [
		'delivery_id', 'content', 'size', 'hight', 'long', 'width', 'initial_offer', 'final_offer'
	];

	public function delivery_detail()
	{
		return $this->belongsTo(Delivery::class);
	}

	/**
	 * Get the delivery's initial offer in number format.
	 *
	 * @return string
	 */
	public function getInitialOfferAttribute($value)
	{
		return number_format(intval($value), 2);
	}

	/**
	 * Get the delivery's final offer in number format.
	 *
	 * @return string
	 */
	public function getFinalOfferAttribute($value)
	{
		return number_format(intval($value), 2);
	}
}
