<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            
            $table->integer('product_id')->unsigned()->nullable()->default(12);
            
            $table->integer('category_id')->unsigned()->nullable()->default(12);
            
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products');
            
            $table->foreign('category_id')->references('id')->on('categorys');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
        $table->integer('product_id')->unsigned()->nullable()->default(12);
            
        $table->integer('category_id')->unsigned()->nullable()->default(12);
        
        $table->timestamps();
        
        $table->foreign('product_id')->references('id')->on('products');
        
        $table->foreign('category_id')->references('id')->on('categorys');
    }
}
