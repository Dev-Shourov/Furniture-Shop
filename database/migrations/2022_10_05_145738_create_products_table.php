<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('prod_name')->unique();
            $table->string('prod_str');
            $table->text('prod_desc')->nullable();
            $table->text('prod_ft_img')->nullable();
            $table->text('prod_ad_img')->nullable();
            $table->integer('prod_qty');
            $table->string('prod_price');
            $table->integer('prod_cat')->nullable();
            $table->string('prod_tag')->nullable();
            $table->string('prod_discount')->nullable();
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
        Schema::dropIfExists('products');
    }
};
