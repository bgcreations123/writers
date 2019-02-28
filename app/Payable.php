<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Payable extends Model
{
    public function review()
	{
	    return $this->belongsTo(Review::class);
	}

	public function paymentStatus()
	{
	    return $this->belongsTo(PaymentStatus::class);
	}
}
