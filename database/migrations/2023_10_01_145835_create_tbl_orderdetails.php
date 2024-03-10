<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orderdetails', function (Blueprint $table) {
            $table->bigIncrements('orderdetails_id');
            $table->integer('product_id');
            $table->integer('product_name');

            $table->Float('product_price');

            $table->integer('product_quantity');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_orderdetails');
    }
}
