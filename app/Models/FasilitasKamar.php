<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FasilitasKamar extends Model
{
    use HasFactory;
    protected $table = 'fasilitas_kamar';
    protected $fillable = ['kamar_type_id', 'fasilitas_id'];

    public function kamarType()
    {
        return $this->belongsTo(KamarType::class, 'kamar_type_id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    }
}
