<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_prediction', function (Blueprint $table) {
            $table->id();
            $table->datetime('start');
            $table->datetime('end');
            $table->string('type');

            $table->integer('temperature_min');
            $table->integer('temperature_max');
            $table->integer('windspeed_min')->unsigned();
            $table->integer('windspeed_max')->unsigned();
            $table->integer('radiation_min')->unsigned();
            $table->integer('radiation_max')->unsigned();
            $table->integer('pressure_min')->unsigned();
            $table->integer('pressure_max')->unsigned();
            $table->integer('humidity_min')->unsigned();
            $table->integer('humidity_max')->unsigned();
            $table->integer('precipitation_min')->unsigned();
            $table->integer('precipitation_max')->unsigned();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_prediction');
    }
};
