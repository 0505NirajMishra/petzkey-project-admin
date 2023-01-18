<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {        
        Schema::create('companyservices', function (Blueprint $table) {
            $table->increments('cmpny_dtls_id');
            $table->string('company_name');
            $table->integer('company_lic_no');
            $table->string('company_licence_photo')->nullable();
            $table->string('company_work_photo')->nullable();
            $table->string('company_image_logo')->nullable();
            $table->string('company_location');
            $table->string('company_address');
            $table->string('company_map_location');
            $table->string('company_aboutus');
            $table->integer('user_reg_id')->nullable();
            $table->integer('servicetype_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companyservices');
    }
};
