<?php

namespace App\Models;

use App\Models\User;
use App\Models\Fasilitas;
use App\Models\KamarType;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    protected $fillable = ['user_id', 'kamar_type_id', 'no_kamar', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kamarType()
    {
        return $this->belongsTo(KamarType::class, 'kamar_type_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'kamar_id');
    }

}
