<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_product', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('product_id')->unsigned();
			$table->foreign('product_id')
				->references('id')
				->on('products');
			$table->bigInteger('cart_id')->unsigned();
			$table->foreign('cart_id')
				->references('id')
				->on('carts');
				
			$table->tinyInteger('active')->default(0);
			$table->string('sku');
			$table->decimal('price', 10, 2);
			$table->float('discount')->default(0);
			$table->integer('quantity')->default(1);
			$table->float('weight')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cart_product');
	}
}
