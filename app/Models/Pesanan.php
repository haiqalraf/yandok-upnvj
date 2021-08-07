<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'PesananView';
    protected $casts = [
        'id' => 'string'
    ];

    public function getData($nim = null, $id = null, $type = 'all')
    {
        
        $query = new Pesanan();

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

    public function getCommentIfExists($model)
    {
        if ($model->source_table==0) {
            return Legalisir::where('nim_pemesan', $model->nim_pemesan)->first()->komentar;
        } elseif ($model->source_table==1) {
            return Suket::where('nim_pemesan', $model->nim_pemesan)->komentar;
        } elseif ($model->source_table==2) {
            return Lainya::where('nim_pemesan', $model->nim_pemesan)->komentar;
        }
    }
}
