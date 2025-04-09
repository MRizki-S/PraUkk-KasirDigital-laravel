<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kamar;
use App\Models\KamarType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $fillable = ['nama_pemesan', 'email', 'no_handphone', 'nama_tamu', 'user_id','kamar_type_id', 'check_in_date', 'check_out_date', 'jumlah_kamar', 'no_kamar', 'total_harga'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kamarType()
    {
        return $this->belongsTo(KamarType::class, 'kamar_type_id');
    }
}
