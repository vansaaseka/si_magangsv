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
        Schema::create('ajuan_logbooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ajuan_magang_id')->nullable();
            $table->unsignedBigInteger('logbook_id')->nullable();
            $table->timestamps();

            $table->foreign('ajuan_magang_id')->references('id')->on('ajuan_magangs')->onDelete('cascade');
            $table->foreign('logbook_id')->references('id')->on('logbooks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuan_logbooks');
    }
};
