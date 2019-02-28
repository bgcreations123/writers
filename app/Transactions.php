<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
