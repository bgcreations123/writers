<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messagesFiles extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function message()
	{
	    return $this->belongsTo(Message::class);
	}
}
