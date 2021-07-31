<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Carbon\Carbon;

class CreateMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nim'=>'18105',
                'nama'=>'albet',
                'tahun_lulus'=>Carbon::parse('2000-01-01'),
                'email'=>'albet@upn.com',
                'no_hp'=>'081123456789',
                'no_rumah'=>'081123456780',
                'pekerjaan'=>'PT Yasagama - Design UI/UX',
                'alamat'=>'jl. kampung rambutan',
            ],
        ];
  
        foreach ($user as $key => $value) {
            Mahasiswa::create($value);
        }
    }
}
