<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualan';
    protected $fillable = [
        'penjualan_id', 'produk_id', 'jumlah_produk', 'subtotal'
    ];

     // Relasi ke tabel penjualan
     public function penjualan()
     {
         return $this->belongsTo(Penjualan::class, 'penjualan_id');
     }

     // Relasi ke tabel produk
     public function produk()
     {
         return $this->belongsTo(Produk::class, 'produk_id');
     }
}
