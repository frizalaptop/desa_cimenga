<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->date('tanggal_surat')->nullable();
            $table->string('pengirim')->nullable();
            $table->string('perihal')->nullable();
            $table->string('file_scan')->nullable(); // path file scan (pdf/jpg)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomings');
    }
};
