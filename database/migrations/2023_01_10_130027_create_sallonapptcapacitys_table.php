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
        Schema::create('sallonapptcapacitys', function (Blueprint $table) {
            $table->increments('sallon_apt_cap_id');
            $table->string('sallon_apt_cap');
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
        Schema::dropIfExists('sallonapptcapacitys');
    }
};
