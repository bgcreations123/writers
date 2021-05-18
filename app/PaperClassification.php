<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PaperClassification extends Model
{
    protected $fillable = [
        'classification',
    ];

    /**
     * Get the product that owns the classification.
     */
    public function product()
	{
	    return $this->belongsTo(Product::class);
	}
}
