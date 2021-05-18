<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    public function reviewer()
	{
	    return $this->belongsTo(User::class);
	}

	public function completedJob()
	{
	    return $this->belongsTo(CompletedJob::class);
	}

	public function reviewStatus()
	{
	    return $this->belongsTo(ReviewStatus::class);
	}
}
