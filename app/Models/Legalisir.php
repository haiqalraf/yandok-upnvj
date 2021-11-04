<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Legalisir extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'legalisir';
    public $timestamp = true;

    protected $cast = [
        'dok_01' => 'float',
        'dok_02' => 'float',
        'dok_03' => 'float',
        'dok_04' => 'float',
        'dok_05' => 'float',
        'dok_06' => 'float',
        'dok_07' => 'float',
        'dok_08' => 'float',
        'dok_09' => 'float',
        'dok_10' => 'float',
        'dok_11' => 'float',
        'dok_12' => 'float',
    ];

    protected $fillable = [
        'nim_pemesan',
        'dok_01',
        'dok_02',
        'dok_03',
        'dok_04',
        'dok_05',
        'dok_06',
        'dok_07',
        'dok_08',
        'dok_09',
        'dok_10',
        'dok_11',
        'dok_12',
        'file',
        'komentar',
        'kebutuhan',
        'keterangan',
        'tujuan',
        'alamat',
        'verifikasi',
        'created_at',
    ];

    public function getData($nim = null, $id = null, $type = 'all'){
        
        $query = new Legalisir();

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

    public function daftarPesanan() 
    {
        $daftar_pesanan = collect([]);
        if ($this->dok_01 > 0) {
            $daftar_pesanan->put('Legalisir Ijazah', $this->dok_01);
        }
        if ($this->dok_02 > 0) {
            $daftar_pesanan->put('Legalisir Transkrip', $this->dok_02);
        }
        if ($this->dok_03 > 0) {
            $daftar_pesanan->put('Legalisir Piagam Cum Laude', $this->dok_03);
        }
        if ($this->dok_04 > 0) {
            $daftar_pesanan->put('Terjemahan Ijazah', $this->dok_04);
        }
        if ($this->dok_05 > 0) {
            $daftar_pesanan->put('Terjemahan Transkrip', $this->dok_05);
        }
        if ($this->dok_06 > 0) {
            $daftar_pesanan->put('Terjemahan Piagam Cumlaude', $this->dok_06);
        }
        if ($this->dok_07 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Studi (Tanggal Lulus)', $this->dok_07);
        }
        if ($this->dok_08 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Studi (Saat Ini)', $this->dok_08);
        }
        if ($this->dok_09 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Institusi (Tanggal Lulus)', $this->dok_09);
        }
        if ($this->dok_10 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Institusi (Saat Ini)', $this->dok_10);
        }
        if ($this->dok_11 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Profesi - Spesialis (Tanggal Lulus)', $this->dok_11);
        }
        if ($this->dok_12 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Profesi - Spesialis (Saat Ini)', $this->dok_12);
        }

        return $daftar_pesanan;
    }

    public function isKebutuhanForAkpk() { 
        $kebutuhan = Str::lower($this->kebutuhan);
        if( $kebutuhan == 'asn') {
            return true;
        } elseif ($kebutuhan == 'tni atau polri') {
            return true;
        }
        return false;
    }

    // to use this, type name variable ->text_tujuan
    // example : $legalisir->text_tujuan
    public function getTextTujuanAttribute()
    {
        if ($this->tujuan==1) {
            return "Ambil Langsung ke UPNVJ";
        } elseif ($this->tujuan==2) {
            return "Dikirim ke Alamat Saya";
        } else  {
            return "";
        }
    }
}
