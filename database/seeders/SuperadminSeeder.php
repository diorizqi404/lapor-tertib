<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'school_id' => '0',
            'role' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'phone' => '1234567890',
            'gender' => 'L',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('schools')->insert([
            'name' => 'SMKN 2 Surabaya',
            'email' => 'smkn2.sby@example.com',
            'address' => 'JL TGP',
            'phone' => '0123456789',
        ]);

        DB::table('users')->insert([
            'school_id' => '1',
            'role' => 'admin',
            'name' => 'Admin SMKN 2',
            'email' => 'admin2@mail.com',
            'phone' => '1234567890',
            'gender' => 'L',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
