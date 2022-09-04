<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_category', function (Blueprint $table) {
			$table->bigInteger('product_id')->unsigned();
			$table->foreign('product_id')
				->references('id')
				->on('products');
			$table->bigInteger('category_id')->unsigned();
			$table->foreign('category_id')
				->references('id')
				->on('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_category');
	}
}
