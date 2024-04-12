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
        Schema::create('geofences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('latitude1', 10, 7);
            $table->decimal('longitude1', 10, 7);
            $table->decimal('latitude2', 10, 7);
            $table->decimal('longitude2', 10, 7);
            $table->decimal('latitude3', 10, 7);
            $table->decimal('longitude3', 10, 7);
            $table->decimal('latitude4', 10, 7);
            $table->decimal('longitude4', 10, 7);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geofences');
    }
};
