<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('sallonservicess', function (Blueprint $table) {
            $table->increments('sallon_servc_id');
            $table->string('pettype');
            $table->string('sallon_servc_name');
            $table->string('sallon_servc_img');
            $table->string('sallon_servc_pckgtyp');
            $table->string('cntr_fee');
            $table->string('home_fee');
            $table->integer('user_reg_id')->nullable();
            $table->integer('servicetype_id')->nullable();
            $table->integer('cmpny_dtls_id')->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('sallonservicess');
    }
};