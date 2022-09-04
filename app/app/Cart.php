<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  public function user() {
		return $this->belongsTo('App\User');
	}

	public function products()
	{
		return $this->belongsToMany('App\Product', 'cart_product')
			->withTimestamps()
			->withPivot([
				'active', 'sku', 'price', 'discount', 'quantity', 'weight'
			]);
	}
}
