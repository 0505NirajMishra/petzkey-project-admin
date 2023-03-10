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
        Schema::create('hostelsers', function (Blueprint $table) {
            $table->increments('hostel_servc_id');
            $table->string('pettype');
            $table->integer('hrs_fee');
            $table->integer('day_fee');
            $table->integer('hos_seat');
            $table->string('desc');
            $table->integer('user_reg_id')->nullable();
            $table->integer('servicetype_id')->nullable();
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
        Schema::dropIfExists('hostelsers');
    }
};
