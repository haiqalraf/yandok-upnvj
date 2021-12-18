<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lainya;
use Illuminate\Database\Seeder;

class LainyaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('id', '>', '11')->get();
        Lainya::factory()->count(100)->sequence(fn ($sequence) => ['nim_pemesan' => $users->random()->nim])->create();
    }
}
