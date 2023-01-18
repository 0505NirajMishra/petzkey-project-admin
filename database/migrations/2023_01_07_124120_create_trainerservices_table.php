<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trainerservices', function (Blueprint $table) {
            $table->increments('trainer_servc_id');
            $table->string('pettype');
            $table->string('trainer_servc_name');            
            $table->string('trainer_servc_img');
            $table->string('trainer_servc_packagetype');
            $table->integer('cntr_fees');
            $table->integer('home_fees');
            $table->integer('user_reg_id')->nullable();
            $table->integer('servicetype_id')->nullable();
            $table->integer('cmpny_dtls_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainerservices');
    }
};
