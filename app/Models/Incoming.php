<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    use HasFactory;

    protected $table = 'incomings';

    protected $fillable = [
        'no_surat',
        'tanggal_surat',
        'pengirim',
        'perihal',
        'file_scan',
    ];
}
 