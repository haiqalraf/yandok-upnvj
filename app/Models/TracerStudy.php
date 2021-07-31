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
        'status_kerja',
        'waktu_kontrak',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
