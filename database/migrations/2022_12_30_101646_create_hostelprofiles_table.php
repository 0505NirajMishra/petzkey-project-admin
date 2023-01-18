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
        Schema::create('hostelprofiles', function (Blueprint $table) {
            $table->increments('hostle_img_id');
            $table->integer('servicetype_id')->nullable();
            $table->integer('company_dtls_id')->nullable();
            $table->string('hostel_image');
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
        Schema::dropIfExists('hostelprofiles');
    }
};