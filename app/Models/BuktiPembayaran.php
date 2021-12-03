<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'bukti_pembayaran';
    
    protected $fillable = [
        'bank',
        'owner',
        'norek',
        'jml_bayar',
        'tgl_bayar',
        'bukti_bayar',
    ];

    protected $casts = [
        'tgl_bayar' => 'date',
        'confirmed_at' => 'datetime'
    ];

    public function pesanan()
    {
        return $this->morphTo();
    }
}
