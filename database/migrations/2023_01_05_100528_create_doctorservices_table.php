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
        Schema::create('doctorservices', function (Blueprint $table) {
            $table->increments('doctor_servc_id');
            $table->string('pettype');
            $table->string('clinic_fee');
            $table->string('home_fee');
            $table->string('desc');
            $table->integer('servicetype_id')->nullable();
            $table->integer('user_reg_id')->nullable();
            $table->integer('cmpny_dtls_id')->nullable();
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
        Schema::dropIfExists('doctorservices');
    }
};
