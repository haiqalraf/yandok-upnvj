<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    public $timestamp = true;

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'no_hp',
        'no_rumah',
        'foto',
        'pekerjaan',
        'alamat'
    ];

    protected $casts = [
   
    ];
}
