<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suket extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'suket';
    public $timestamp = true;

    protected $fillable = [
        'nim_pemesan',
        'dokumen_dipesan',
        'verifikasi',
        'komentar',
        'file',
        'final_dokumen'
    ];

    protected $casts = [
        'dokumen_dipesan' => 'array',
        'file' => 'array',
    ];

    public function getData($nim = null, $id = null, $type = 'all'){
        
        $query = new Suket();

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

    public function documentRequirement($key)
    {
        if (strpos($key, 'Pengganti'))
            return ["Scan FC Ijazah (Bagi yang memesan Pengganti Ijazah)",
            "Scan FC Transkrip (Bagi yang memesan Pengganti Transkrip)",
            "Scan FC SKPI (Bagi yang memesan Pengganti SKPI)",
            "Surat permohonan yang ditujukan ke dekan",
            "Akte kelahiran / Akte Notaris",
            "Foto 3x4 hitam putih"];
        elseif (strpos($key, 'Perubahan')||strpos($key, 'Ralat'))
            return ["Scan FC Ijazah (Bagi yang memesan Perubahan/Ralat Ijazah)",
            "Scan FC Transkrip (Bagi yang memesan Perubahan/Ralat Transkrip)",
            "Surat permohonan yang ditujukan ke dekan",
            "Surat Keterangan Hilang Dari Polisi",
            "Foto 3x4 hitam putih"];
        elseif (strpos($key, 'Alumni'))
            return ["Scan Ijazah / Transkrip Nilai"];
    }

    public function getRawTujuanAttribute()
    {
        return $this->attributes['tujuan'];
    }
}
