<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
						$table->timestamps();
						$table->string('name')->unique();
						$table->string('meta_name')->unique();
						$table->string('slug')->unique();
						$table->text('description')->nullable();
						$table->string('sku')->unique();
						$table->decimal('price', 10, 2);
						$table->float('discount')->default(0);
						$table->integer('quantity')->default(0);
						$table->float('weight')->nullable();
						$table->json('options')->nullable();
						$table->json('image_urls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
