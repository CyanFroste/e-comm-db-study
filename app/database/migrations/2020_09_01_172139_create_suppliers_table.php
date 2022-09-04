<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
						$table->timestamps();
						$table->string('name')->unique();
						$table->string('meta_name')->unique();
						$table->string('slug')->unique();
						$table->text('description')->nullable();
						$table->string('phone')->nullable();
						$table->string('line_one')->nullable();
						$table->string('line_two')->nullable();
						$table->string('city')->nullable();
						$table->string('state')->nullable();
						$table->text('image_url')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
