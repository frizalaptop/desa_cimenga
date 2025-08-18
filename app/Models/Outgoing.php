<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    use HasFactory;

    protected $table = 'outgoing';

    protected $fillable = [
        'no_surat',
        'tanggal_surat',
        'tujuan',
        'perihal',
        'file_pdf',
    ];
}
 