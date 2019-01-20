<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    /**
     * Get the user that owns the order.
     */
    public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function paymentStatus()
	{
	    return $this->belongsTo(PaymentStatus::class);
	}
}
