<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name')->unique();
			$table->string('meta_name')->unique();
			$table->string('slug')->unique();
			$table->text('description')->nullable();
			$table->bigInteger('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')
				->references('id')
				->on('categories')
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
		Schema::dropIfExists('categories');
	}
}
