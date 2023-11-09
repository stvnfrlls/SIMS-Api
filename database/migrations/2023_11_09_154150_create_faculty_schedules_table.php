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
        Schema::create('faculty_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('academicYear');
            $table->unsignedBigInteger('facultyId');
            $table->unsignedBigInteger('subjectId');
            $table->unsignedBigInteger('gradeId');
            $table->string('startTime');
            $table->string('endTime');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('facultyId')->references('id')->on('faculty_records');
            $table->foreign('subjectId')->references('id')->on('curricula');
            $table->foreign('gradeId')->references('id')->on('grade_levels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_schedules');
    }
};
