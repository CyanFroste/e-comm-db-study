<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'meta_name' => $faker->name,
		'slug' => $faker->unique()->slug
	];
});
