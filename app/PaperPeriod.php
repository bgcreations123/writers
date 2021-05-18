<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PaperPeriod extends Model
{
    protected $fillable = [
        'period',
    ];

    /**
     * Get the product that owns the period.
     */
    public function product()
	{
	    return $this->belongsTo(Product::class);
	}
}
