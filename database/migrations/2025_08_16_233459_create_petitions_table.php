<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke resident
            $table->foreignId('resident_id')->constrained('residents')->cascadeOnDelete();
            
            // Relasi ke letter
            $table->foreignId('letter_id')->constrained('letters')->cascadeOnDelete();
            
            $table->text('keperluan')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            $table->string('file_pdf')->nullable();
            
            // siapa admin/rt/rw yang approve
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petitions');
    }
};
