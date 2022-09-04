<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
						$table->timestamps();
						$table->bigInteger('user_id')->unsigned();
						$table->foreign('user_id')
							->references('id')
							->on('users')
							->onDelete('cascade');
						$table->string('first_name');
						$table->string('last_name');
						$table->string('phone');
						$table->string('line_one');
						$table->string('line_two');
						$table->string('city');
						$table->string('state');
						$table->string('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
