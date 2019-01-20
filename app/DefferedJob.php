<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DefferedJob extends Model
{
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
}
