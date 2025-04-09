<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KamarType extends Model
{
    use HasFactory;
    protected $table = 'kamar_type';
    protected $fillable = ['nama', 'deskripsi', 'harga_permalam', 'jumlah_kamar', 'image'];

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'kamar_type_id');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_kamar', 'kamar_type_id', 'fasilitas_id');
    }
}
