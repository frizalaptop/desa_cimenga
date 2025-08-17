<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    protected $table = 'petitions';

    protected $fillable = [
        'resident_id',
        'letter_id',
        'keperluan',
        'status',
        'file_pdf',
        'approved_by',
    ];

    // Relasi ke resident (pemohon)
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    // Relasi ke jenis surat
    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    // Relasi ke User (admin/RT/RW yang approve)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
