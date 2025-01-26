<?php

namespace App\Models;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $fillable = [
        'nama_pelanggan', 'alamat', 'no_telepon'
    ];

    // Relasi ke tabel penjualan
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'pelanggan_id');
    }


}
