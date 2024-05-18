<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeetimelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_time_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->timestamp('check_in_time');
            $table->timestamp('check_out_time')->nullable(); // Allow NULL for the default value
            $table->foreignId('project_id')->constrained('projects');
            // Other time log-related fields
            // $table->timestamps();
            // $table->unsignedBigInteger('geofence_id')->nullable();
            // $table->foreign('geofence_id')->references('id')->on('geofences')->onDelete('set null');
            // $table->ifNotExists();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_timelogs');
    }
}
