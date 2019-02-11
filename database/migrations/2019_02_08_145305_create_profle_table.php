<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('lastt_name');
            $table->string('phone');                      
           $table->enum('jk', ['L', 'P'])->nullable();          
                     
            $table->boolean('confirmed')->nullable()->default(false);            
            $table->text('foto')->nullable();            
            $table->longText('description')->nullable();
            $table->text('alamat')->nullable();  
            $table->string('imei')->nullable();  
            
            $table->integer('user_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            

            
            
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
        Schema::dropIfExists('profle');
    }
}
