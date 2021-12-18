<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CreateUserSeeder::class,
            CreatePesananSeeder::class,
            LainyaSeeder::class,
            LegalisirSeeder::class,
            SuketSeeder::class
        ]);
    }
}
