<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'price',
    ];

    /**
     * Get the classification that owns the product.
     */
    public function classification()
    {
        return $this->belongsTo('App\PaperClassification');
    }

    /**
     * Get the period that owns the product.
     */
    public function period()
    {
        return $this->belongsTo('App\PaperPeriod');
    }
}
