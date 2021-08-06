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
        'jumlah_dokumen',
        'file',
    ];

    protected $cast = [
        'jumlah_dokumen' => 'float',
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
}
