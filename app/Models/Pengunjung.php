<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $table = 'pengunjungs';

    protected $fillable = ['name', 'alamat', 'profesi', 'instansi', 'no_telp', 'umur', 'tanggal', 'qr_code', 'status', 'waktu'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
