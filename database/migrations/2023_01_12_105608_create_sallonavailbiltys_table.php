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
        Schema::create('sallonavailbiltys', function (Blueprint $table) {
            $table->increments('sallon_avail_id');
            $table->string('avail_days');
            $table->string('ms_opening_time');
            $table->string('ms_closing_time');
            $table->string('es_opening_time');
            $table->string('es_closing_time');
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
        Schema::dropIfExists('sallonavailbiltys');
    }
};
