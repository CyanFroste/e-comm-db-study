<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $hidden = ['pivot'];

	// relationships
	public function products()
	{
		return $this->belongsToMany('App\Product', 'product_category');
	}

	public function parent()
	{
		return $this->belongsTo('App\Category');
	}

	public function children(){
		return $this->hasMany('App\Category', 'parent_id');
	}
}
