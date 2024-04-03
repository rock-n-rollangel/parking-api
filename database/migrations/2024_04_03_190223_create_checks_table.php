<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('amount');
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    public function down()
    {
        Schema::dropIfExists('checks');
    }
};
