<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_order', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('product_id')->unsigned();
			$table->foreign('product_id')
				->references('id')
				->on('products');
			$table->bigInteger('order_id')->unsigned();
			$table->foreign('order_id')
				->references('id')
				->on('orders');
				
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
		Schema::dropIfExists('product_order');
	}
}
