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
        Schema::create('advisory_classes', function (Blueprint $table) {
            $table->id();
            $table->string('academicYear');
            $table->unsignedBigInteger('gradeId');
            $table->unsignedBigInteger('facultyId');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gradeId')->references('id')->on('grade_levels');
            $table->foreign('facultyId')->references('id')->on('faculty_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisory_classes');
    }
};
