<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Korisnik',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ]
        );
    }
}
