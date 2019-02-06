<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Reject extends Model
{
    public function review()
	{
	    return $this->belongsTo(Review::class);
	}
}
