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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('usia');
            $table->string('pendidikan_terakhir');
            $table->string('jurusan');
            $table->string('status_pernikahan');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('no_hp');
            $table->string('asal_sekolah');
            $table->string('lampiran_ijazah');
            $table->string('lampiran_cv');
            $table->string('lampiran_ktp');
            $table->string('lampiran_keterangan_sehat');
            $table->string('lampiran_skck');
            $table->decimal('total_score', 5, 2)->default(0)->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vacancy_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
