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
        Schema::create('ajuan_magangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_semester_id')->nullable();
            $table->unsignedBigInteger('instansi_id')->nullable();
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->unsignedBigInteger('laporan_akhir_id')->nullable();
            $table->string('anggota_id')->nullable();
            $table->integer('angkatan');
            $table->enum('jenis_ajuan', ['jenis_baru', 'jenis_perbaikan'])->nullable();
            $table->enum('jenis_kegiatan', ['individu', 'kelompok'])->nullable();
            $table->string('status')->nullable();
            $table->string('komentar_status')->nullable();
            $table->string('dosen_pembimbing');
            $table->integer('bobot_sks');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('surat_pengantar')->nullable();
            $table->string('file_nilai')->nullable();
            $table->string('bukti_magang')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tahun_ajaran_semester_id')->references('id')->on('tahun_ajaran_semesters')->onDelete('cascade');
            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->foreign('laporan_akhir_id')->references('id')->on('laporan_akhirs')->onDelete('cascade');
            $table->foreign('instansi_id')->references('id')->on('instansis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuan_magangs');
    }
};
