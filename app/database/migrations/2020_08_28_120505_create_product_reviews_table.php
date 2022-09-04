<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_reviews', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('title');
			$table->text('review')->nullable();
			$table->integer('rating');
			$table->bigInteger('product_id')->unsigned();
			$table->foreign('product_id')
				->references('id')
				->on('products')
				->onDelete('cascade');
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_reviews');
	}
}
