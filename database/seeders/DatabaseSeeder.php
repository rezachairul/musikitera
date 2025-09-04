<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin UKMBSM',
            'email' => 'admin@ukmbsm.itera.ac.id',
            'email_verified_at' => now(),
            'password' => bcrypt('musikitera2016'), // password default
            'remember_token' => Str::random(10),
        ]);
    }
}
