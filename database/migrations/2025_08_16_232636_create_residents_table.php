<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('kk', 16)->nullable();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('agama')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kewarganegaraan')->default('WNI');
            $table->timestamps();
            
            // Relasi ke users (jika warga punya akun)
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
