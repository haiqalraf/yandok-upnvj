<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
