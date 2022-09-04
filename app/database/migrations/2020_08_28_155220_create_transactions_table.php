<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')
				->references('id')
				->on('users');
			$table->bigInteger('order_id')->unsigned();
			$table->foreign('order_id')
				->references('id')
				->on('orders');

			$table->text('description')->nullable();
			$table->string('code');
			$table->enum('type', ['credit', 'debit']);
			$table->enum('mode', ['COD', 'debit card', 'credit card', 'UPI'])->default('COD');
			$table->enum('status', ['new', 'cancelled', 'failed', 'pending', 'declined', 'rejected', 'success'])->default('new');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('transactions');
	}
}
