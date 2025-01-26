<?php

namespace App\Models;

use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'tanggal_penjualan', 'total_harga', 'pelanggan_id'
    ];

    // Relasi ke tabel pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    // Relasi ke tabel detailpenjualan
    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }

}
