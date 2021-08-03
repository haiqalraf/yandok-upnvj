<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
               'name'=>'Admin',
               'nim'=>'18106',
                'is_admin'=>'1',
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'AKPK',
                'nim'=>'18107',
                 'is_admin'=>'2',
                'password'=> bcrypt('123456'),
             ],
             [
                'name'=>'Dekan',
                'nim'=>'18108',
                 'is_admin'=>'3',
                'password'=> bcrypt('123456'),
             ],
            [
                'nim'=>'18105',
                'name'=>'albet',
                'thn_lulus'=>Carbon::parse('2000-01-01'),
                'email'=>'albet@upn.com',
                'no_hp'=>'081123456789',
                'no_rumah'=>'081123456780',
                'pekerjaan'=>'PT Yasagama - Design UI/UX',
                'address'=>'jl. kampung rambutan',
                'is_admin'=>'0',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
