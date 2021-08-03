<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Legalisir;
use App\Models\Suket;
use App\Models\Lainya;

class CreatePesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $legalisir = [

            [
                'id'=>'123',
                'nim_pemesan'=>'18105',
                'dok_01'=>'1.00',
                'dok_03'=>'2.00',
                'kebutuhan'=>'ASN',
                'keterangan'=>'tidak ada',
                'verifikasi'=>'1',
                'created_at'=>'2021-07-31 16:46:47',
            ]
        ];
        foreach ($legalisir as $key => $value) {
            Legalisir::create($value);
        }
        
        $suket = [
            [
                'id'=>'124',
                'nim_pemesan'=>'18105',
                'dokumen_dipesan'=>'Surat Keterangan Ralat Ijazah',
                'verifikasi'=>'1',
                'created_at'=>'2021-07-31 16:46:47',
            ]
        ];
        foreach ($suket as $key => $value) {
            Suket::create($value);
        }

        $lain = [
            [
                'id'=>'125',
                'nim_pemesan'=>'18105',
                'dokumen_dipesan'=>'Surat lainya test',
                'verifikasi'=>'1',
                'jumlah_dokumen'=>'2',
                'created_at'=>'2021-07-31 16:46:47',
            ]
        ];
        foreach ($lain as $key => $value) {
            Lainya::create($value);
        }

    }
}
