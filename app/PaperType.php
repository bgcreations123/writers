<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PaperType extends Model
{
    protected $fillable = [
		'name',
	    'description',
	];
}
