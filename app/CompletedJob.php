<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CompletedJob extends Model
{
    public $orderBy = 'completed_jobs.id'; 

    public $orderDirection = 'DESC';

    public function orderDetail()
	{
	    return $this->belongsTo(OrderDetail::class);
	}

	public function writer()
	{
	    return $this->belongsTo(User::class);
	}

	public function product()
	{
	    return $this->belongsTo(Product::class);
	}

	public function paymentStatus()
	{
	    return $this->belongsTo(PaymentStatus::class);
	}
}
