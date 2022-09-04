<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
	// relationships
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
