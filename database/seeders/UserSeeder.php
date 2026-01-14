<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\admin\administrator\User;

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
            'Administrator'  => 'admin',
            'Pembina'  => 'pembina',
        ];

        foreach ($roles as $roleName => $prefix) {
            User::create([
                'name'              => ucwords($roleName) . ' UKMBSM',
                'email'             => "{$prefix}.{$prefix}@ukmbsm.itera.ac.id",
                'role'              => $prefix,
                'email_verified_at' => now(),
                'password'          => Hash::make('musikitera2016'),
                'remember_token'    => Str::random(10),
            ]);
        }

    }
}
