<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carts', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('session_id');
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')
				->references('id')
				->on('users');

			$table->string('token');
			$table->enum('status', ['new', 'current cart', 'saved for later', 'paid', 'abandoned'])->default('new');
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
		Schema::dropIfExists('carts');
	}
}
