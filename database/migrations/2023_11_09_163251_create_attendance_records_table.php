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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->string('academicYear');
            $table->unsignedBigInteger('studentId');
            $table->string('timeIn');
            $table->string('timeOut');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('studentId')->references('id')->on('student_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
