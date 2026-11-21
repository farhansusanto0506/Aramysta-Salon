<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@Aramysta.com'],
            [
                'name' => 'Admin Aramysta',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            ServiceSeeder::class,
        ]);
    }
}