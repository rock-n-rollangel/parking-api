<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_space_id')->nullable();
            $table->string('number');
            $table->timestamp('entered_at');
            $table->timestamp('left_at')->nullable();
            $table->timestamps();

            $table->foreign('parking_space_id')->references('id')->on('parking_spaces');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
