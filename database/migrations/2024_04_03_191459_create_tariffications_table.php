<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tariffications', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('active_from')->nullable();
            $table->unsignedMediumInteger('active_to')->nullable();
            $table->unsignedBigInteger('price');
            $table->boolean('default')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tariffications');
    }
};
