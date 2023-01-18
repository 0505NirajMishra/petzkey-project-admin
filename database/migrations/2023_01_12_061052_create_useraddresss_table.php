<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('useraddresss', function (Blueprint $table) {
            $table->increments('address_id');
            $table->string('address');
            $table->integer('user_reg_id')->nullable();
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('useraddresss');
    }

    
};