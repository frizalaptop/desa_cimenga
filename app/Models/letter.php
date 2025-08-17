<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $table = 'letters';

    protected $fillable = [
        'nama_surat',
        'kode_surat',
        'template_file',
    ];

    // Relasi ke permohonan surat
    public function petition()
    {
        return $this->hasMany(Petition::class);
    }
}
