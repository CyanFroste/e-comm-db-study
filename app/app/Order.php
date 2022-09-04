<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	// relationships
	public function products()
	{
		return $this->belongsToMany('App\Product', 'product_order')
			->withTimestamps()
			->withPivot([
				'sku', 'price', 'discount', 'quantity', 'weight'
			]);
	}

	// 
	public function users()
	{
		return $this->belongsToMany('App\Product', 'transactions')
			->as('transaction')
			->withTimestamps()
			->withPivot([
				'description', 'code', 'type', 'mode', 'status'
			]);
	}
	//

	public function user() {
		return $this->belongsTo('App\User');
	}

}
