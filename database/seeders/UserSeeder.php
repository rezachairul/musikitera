<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Badan Pengurus' => 'bph',
            'Dewan Pengawas' => 'dpo',
            'Admin'          => 'admin',
        ];

        foreach ($roles as $roleName => $prefix) {
            User::create([
                'name'              => strtoupper(str_replace(' ', '', $roleName)) . ' UKMBSM',
                'email'             => "{$prefix}.{$prefix}@ukmbsm.itera.ac.id",
                'email_verified_at' => now(),
                'password'          => Hash::make('musikitera2016'),
                'remember_token'    => Str::random(10),
            ]);
        }
    }
}
