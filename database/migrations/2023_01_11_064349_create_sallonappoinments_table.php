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
        Schema::create('sallonappoinments', function (Blueprint $table) {
            $table->increments('appt_id');
            $table->integer('appt_no')->nullable();
            $table->string('appt_date_time');
            $table->string('book_date_time');
            $table->integer('cust_id')->nullable();
            $table->string('progress_status');
            $table->integer('payment');
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
        Schema::dropIfExists('sallonappoinments');
    }
};
