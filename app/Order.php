<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    /**
     * Get the user that owns the order.
     */
    public function client()
	{
	    return $this->belongsTo(User::class, 'user_id');
	}

	public function paymentStatus()
	{
	    return $this->belongsTo(PaymentStatus::class);
	}
}
