<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
						$table->timestamps();
						$table->bigInteger('product_id')->unsigned();
						$table->foreign('product_id')->references('id')->on('products');
						$table->bigInteger('supplier_id')->unsigned();
						$table->foreign('supplier_id')->references('id')->on('suppliers');
						
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_supplier');
    }
}
