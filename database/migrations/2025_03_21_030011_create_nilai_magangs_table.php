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
        Schema::create('nilai_magangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ajuan_magang_id')->nullable();
            $table->unsignedBigInteger('kriteria_nilai_id')->nullable();
            $table->timestamps();

            $table->foreign('ajuan_magang_id')->references('id')->on('ajuan_magangs')->onDelete('cascade');
            $table->foreign('kriteria_nilai_id')->references('id')->on('kriteria_nilais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_magangs');
    }
};
