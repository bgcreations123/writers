<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompletedJobsFiles extends Model
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

    public function CompletedJob()
	{
	    return $this->belongsTo(CompletedJob::class);
	}
}
