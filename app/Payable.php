<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Payable extends Model
{
    public function writer()
	{
	    return $this->belongsTo(User::class);
	}

	public function review()
	{
	    return $this->belongsTo(Review::class);
	}

	public function orderDetail()
	{
	    return $this->belongsTo(OrderDetail::class);
	}

	public function paymentStatus()
	{
	    return $this->belongsTo(PaymentStatus::class);
	}
}
