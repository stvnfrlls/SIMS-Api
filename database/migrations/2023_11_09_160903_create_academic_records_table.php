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
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id();
            $table->string('academicYear');
            $table->unsignedBigInteger('studentId');
            $table->string('gradeQuarter');
            $table->unsignedBigInteger('subjectId');
            $table->string('gradeValue');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('studentId')->references('id')->on('student_records');
            $table->foreign('subjectId')->references('id')->on('curricula');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_records');
    }
};
