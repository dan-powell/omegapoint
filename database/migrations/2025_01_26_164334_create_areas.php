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
        Schema::create('area_district', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tier')->nullable();
            $table->timestamps();
        });

        Schema::create('area_poi', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('area_district_poi', function (Blueprint $table) {
            $table->foreignId('district_id')->references('id')->on('area_district')->onDelete('cascade');
            $table->foreignId('poi_id')->references('id')->on('area_poi')->onDelete('cascade');
            $table->unique(['district_id', 'poi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_district_poi');
        Schema::dropIfExists('area_poi');
        Schema::dropIfExists('area_district');
    }
};
