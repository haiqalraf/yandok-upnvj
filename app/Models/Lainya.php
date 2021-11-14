<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lainya extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'lainya';
    public $timestamp = true;

    protected $fillable = [
        'nim_pemesan',
        'komentar',
        'dokumen_dipesan',
        'verifikasi',
        'verifikasi_pengiriman',
        'jumlah_dokumen',
        'file',
    ];

    protected $cast = [
        'jumlah_dokumen' => 'integer',
    ];

    public function getData($nim = null, $id = null, $type = 'all'){
        
        $query = new Lainya();

        if ($id != null){

            $query = $query->where('id', $id);

        }

        if ($nim != null){

            $query = $query->where('nim_pemesan', $nim);

        }

        if ($type == 'all'){
            $data = $query->get();
        } else {
            $data = $query->first();
        }

        return $data;
    }

    public function titleStatus()
    {
        switch ($this->verifikasi) {
            case 0:
                return 'Ditolak';
            case 1:
                return 'Belum Diproses';
            case 2:
                return 'Sedang Diproses';
            case 3:
                return 'Sudah Diproses';
            default:
                return 'Belum Diproses';
        }
    }

    public function getRouteNameAttribute()
    {
        return 'lainnya';
    }

    public function getRawTujuanAttribute()
    {
        return $this->attributes['tujuan'];
    }

    public function buktiBayar()
    {
        return $this->morphOne(BuktiPembayaran::class, 'pesanan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nim_pemesan', 'nim');
    }
}
