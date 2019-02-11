<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateImagesTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
        $table->increments('id');        
        $table->string('name', 100)->nullable()->default('text');
        
        $table->integer('product_id')->unsigned()->nullable()->default(12);
        
        $table->text('link')->nullable()->default('text');
        
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    }); 
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
