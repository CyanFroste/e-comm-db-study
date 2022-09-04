<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $table = 'products';

	protected $hidden = [ 'pivot'	];

	protected $fillable = [
		'name', 'meta_name', 'slug', 'description', 'sku', 'price', 'discount', 'quantity', 'weight', 'options', 'image_urls'
	];

	protected $casts = [
		'image_urls' => 'array'
	];

	// relationships
	public function reviews()
	{
		return $this->hasMany('App\ProductReview');
	}

	public function categories()
	{
		return $this->belongsToMany('App\Category', 'product_category');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag', 'product_tag');
	}

	public function orders()
	{
		return $this->belongsToMany('App\Order', 'product_order')
			->withTimestamps()
			->withPivot([
				'sku', 'price', 'discount', 'quantity', 'weight'
			]);
	}

	public function carts()
	{
		return $this->belongsToMany('App\Cart', 'cart_product')
			->withTimestamps()
			->withPivot([
				'active', 'sku', 'price', 'discount', 'quantity', 'weight'
			]);
	}
}
