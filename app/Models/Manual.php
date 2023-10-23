<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;

    protected $table = 'manual'; // Sesuaikan dengan nama tabel yang ada di basis data Anda

    protected $fillable = [
        'name',
        'alamat',
        'no_hp',
        'umur',
        'tanggal',
        'waktu',
    ];
}
