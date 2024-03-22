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
        Schema::create('project_phases', function (Blueprint $table) {
            $table->id();
            $table->string('phase_name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['planned', 'in_progress', 'completed']);
            $table->foreignId('project_id')->constrained('projects');
            // Other phase-related fields
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_phases');
    }
};
