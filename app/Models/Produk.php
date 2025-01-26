<?php

namespace App\Models;

use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = ['nama_produk', 'harga', 'stok'];

   // Relasi ke tabel detailpenjualan
   public function detailPenjualans()
   {
       return $this->hasMany(DetailPenjualan::class, 'produk_id');
   }
}
