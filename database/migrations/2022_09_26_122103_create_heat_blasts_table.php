<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('heat_blasts', function (Blueprint $table) {
            $table->id();
            // name, email, phone, address, education select2,  image
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('edu_id')->nullable();            
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('heat_blasts');
    }
};
