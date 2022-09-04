<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'meta_name' => $faker->name,
		'slug' => $faker->slug,
		'sku' => $faker->unique()->randomNumber(4),
		'price' => $faker->randomNumber(6),
		'image_urls' => 'www.picsum.com'
	];
});
