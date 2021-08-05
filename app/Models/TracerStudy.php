<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'tempat_kerja',
        'jabatan',
        'alamat_kerja',
        'tanggal_kerja',
        'status_kerja',
        'waktu_kontrak',
    ];

    protected $casts = [
        'tanggal_kerja'=>'date',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
