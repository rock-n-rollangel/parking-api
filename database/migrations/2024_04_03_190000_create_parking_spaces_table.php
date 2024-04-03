<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('parking_spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('state');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parking_spaces');
    }
};
