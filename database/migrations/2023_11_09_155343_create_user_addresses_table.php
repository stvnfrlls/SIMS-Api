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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('address');
            $table->string('barangay');
            $table->unsignedBigInteger('cityId');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('cityId')->references('id')->on('city_municipalities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
