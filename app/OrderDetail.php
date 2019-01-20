<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class OrderDetail extends Model
{
    protected $fillable = [
        'quantity', 'subject', 'sources', 'description', 'files',
    ];

    /**
     * Get the order that owns the order detail.
     */
    public function order()
	{
	    return $this->belongsTo(Order::class);
	}

	public function product()
	{
	    return $this->belongsTo(Product::class);
	}

	public function orderDetailStatus()
	{
	    return $this->belongsTo(OrderDetailStatus::class);
	}

	public function type()
	{
	    return $this->belongsTo(PaperType::class);
	}

	public function format()
	{
	    return $this->belongsTo(PaperFormat::class);
	}

	public function language()
	{
	    return $this->belongsTo(PaperLanguage::class);
	}

	public function spacing()
	{
	    return $this->belongsTo(PaperSpacing::class);
	}
}
