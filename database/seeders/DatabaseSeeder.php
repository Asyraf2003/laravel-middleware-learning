<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'role' => Role::ADMIN, 
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('12345678'),
                'role' => Role::USER,
            ]
        );

        User::updateOrCreate(
            ['email' => 'other@gmail.com'],
            [
                'name' => 'Other Person',
                'password' => Hash::make('12345678'),
                'role' => Role::OTHER,
            ]
        );
    }
}
