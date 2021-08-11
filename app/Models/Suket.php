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
}
