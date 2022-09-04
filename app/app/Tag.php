<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

	protected $hidden = ['pivot'];

	// relationships
	public function products()
	{
		return $this->belongsToMany('App\Product', 'product_tag');
	}
}
