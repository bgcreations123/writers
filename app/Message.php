<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'message',
    ];

    /**
     * Get the user that message sender.
     */
    public function sender()
	{
	    return $this->belongsTo(User::class);
	}

	/**
     * Get the user that message reciever.
     */
    public function reciever()
	{
	    return $this->belongsTo(User::class);
	}

	public function messageStatus()
	{
	    return $this->belongsTo(MessageStatus::class);
	}

    public function MessagesFiles()
    {
        return $this->belongsTo(MessagesFiles::class);
    }
}
