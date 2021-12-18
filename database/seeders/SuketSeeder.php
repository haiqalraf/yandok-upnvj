<?php

namespace Database\Seeders;

use App\Models\Suket;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('id', '>', '11')->get();
        Suket::factory()->count(100)->sequence(fn ($sequence) => ['nim_pemesan' => $users->random()->nim])->create();
    }
}
