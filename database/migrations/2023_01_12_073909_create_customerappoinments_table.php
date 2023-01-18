<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('customerappoinments', function (Blueprint $table) {
            $table->increments('cust_appt_id');
            $table->integer('appt_no')->nullable();
            $table->string('appt_date_time');
            $table->string('book_date_time');
            $table->integer('reg_id')->nullable();
            $table->string('progress_status');
            $table->string('payment');
            $table->integer('user_reg_id')->nullable();
            $table->integer('servicetype_id')->nullable();
            $table->integer('cmpny_dtls_id')->nullable();
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('customerappoinments');
    }
    
};