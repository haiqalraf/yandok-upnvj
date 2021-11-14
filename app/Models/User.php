<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nim',
        'fakultas',
        'password',
        'is_admin',
        'thn_lulus',
        'email',
        'no_hp',
        'no_rumah',
        'pekerjaan',
        'photo',
        'address',
        'is_tracer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function encodeFakultas($fakultas)
    {
        $output = '';
        switch (Str::lower($fakultas)) {
            case 'fakultas ilmu komputer':
                $output = 'FIK';
                break;
            case 'fakultas kedokteran':
                $output = 'FKD';
                break;
            case 'fakultas ilmu kesehatan':
                $output = 'FKS';
                break;
            case 'fakultas ilmu sosial dan ilmu politik':
                $output = 'FSP';
                break;
            case 'fakultas ilmu sosial & ilmu politik':
                $output = 'FSP';
                break;
            case 'fakultas ekonomi & bisnis':
                $output = 'FEB';
                break;
            case 'fakultas ekonomi dan bisnis':
                $output = 'FEB';
                break;
            case 'fakultas teknik':
                $output = 'FTK';
                break;
            case 'fakultas hukum':
                $output = 'FHK';
                break;
            default:
                $output = '';
                break;
        }
        return $output;
    }

    // public function encodeFakultasByNim($nim)
    // {
    //     $output = '';
    //     switch (Str::substr($nim, 4, 3)) {
    //         case 'fakultas ilmu komputer':
    //             $output = 'FIK';
    //             break;
    //         case 'fakultas kedokteran':
    //             $output = 'FKD';
    //             break;
    //         case 'fakultas ilmu kesehatan':
    //             $output = 'FKS';
    //             break;
    //         case 'fakultas ilmu sosial dan ilmu politik':
    //             $output = 'FSP';
    //             break;
    //         case 'fakultas ilmu sosial & ilmu politik':
    //             $output = 'FSP';
    //             break;
    //         case 'fakultas ekonomi & bisnis':
    //             $output = 'FEB';
    //             break;
    //         case 'fakultas ekonomi dan bisnis':
    //             $output = 'FEB';
    //             break;
    //         case 'fakultas teknik':
    //             $output = 'FTK';
    //             break;
    //         case 'fakultas hukum':
    //             $output = 'FHK';
    //             break;
    //         default:
    //             $output = '';
    //             break;
    //         return $output;
    //     }
    // }

    public function adminTitle()
    {
        switch ($this->is_admin) {
            case 0:
                return 'mahasiswa';
            case 1:
                return 'superadmin';
            case 2:
                return 'akpk';
            case 3:
                return 'dekan';
            default:
                return 'mahasiswa';
        }
    }

    public function getIsProfileCompletedAttribute()
    {
        // $total = 5;
        // $data = 0;
        if ($this->is_admin != 0) {
            return true;
        }
        foreach ($this->attributes as $key => $attribute) {
            if(!in_array($key, [
                'id', 
                'created_at', 
                'updated_at', 
                'remember_token', 
                'is_admin', 
                'is_tracer', 
                'email',
                'thn_lulus',
                'tanggal_lahir',
                'password',
                'fakultas',
                'nim',
                'name',
                'email_verified_at',
            ])) {
                // if ($attribute != null) {
                //     $data++;
                // }
                if ($attribute == null) {
                    return false;
                }
            }
        }

        return true;
        // return ($data/$total) * 100;
    }

    public function faculty()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas');
    }
}
