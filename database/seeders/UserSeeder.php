<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vendedor 1',
                'email' => 'vendedor@gmail.com',
                'password' => Hash::make('vendedor123'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cliente 1',
                'email' => 'cliente@gmail.com',
                'password' => Hash::make('cliente123'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
