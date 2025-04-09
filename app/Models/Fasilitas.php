<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\KamarType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fasilitas extends Model
{
    use HasFactory;
    protected $table = 'fasilitas';
    protected $fillable = ['nama', 'deskripsi'];
    
    public function kamarTypes()
    {
        return $this->belongsToMany(KamarType::class, 'fasilitas_kamar', 'fasilitas_id', 'kamar_type_id');
    }
}
