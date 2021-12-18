<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Legalisir;
use Illuminate\Database\Seeder;

class LegalisirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('id', '>', '11')->get();

        // Dummy belum diproses
        Legalisir::factory()->count(100)->sequence(fn ($sequence) => ['nim_pemesan' => $users->random()->nim])->create();
    }
}
