<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('session_id');
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')
				->references('id')
				->on('users');
			$table->string('token');
			$table->enum(
				'status',
				['new', 'pending', 'paid', 'failed', 'shipped', 'out for delivery', 'delivered', 'completed', 'cancelled', 'returned', 'refunded']
			)
				->default('new');
			$table->float('tax');
			$table->decimal('subtotal', 10, 2);
			$table->decimal('total', 10, 2);
			$table->decimal('grand_total', 10, 2);
			$table->float('discount')->default(0);
			$table->decimal('shipping_charge', 10, 2)->nullable();
			$table->string('promo_code')->nullable();
			$table->text('description')->nullable();
			// shipping address foreign key to registered user addresses
			$table->bigInteger('address_id')->unsigned();
			$table->foreign('address_id')
				->references('id')
				->on('addresses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('orders');
	}
}
