<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->id();
						$table->timestamps();
						$table->bigInteger('user_id')->unsigned();
						$table->foreign('user_id')
							->references('id')
							->on('users')
							->onDelete('cascade');
						$table->text('description')->nullable();
						$table->text('thumbnail_url')->nullable();
						$table->string('current_location');
						
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_meta');
    }
}
