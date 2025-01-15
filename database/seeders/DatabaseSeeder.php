<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [[
            'name' => 'Neil Sims',
            'email' => 'neil.sims@flowbite.com',
            'password' => Hash::make('12345678'),
            'isEmployee' => true,
        ],
        [
            'name' => 'Roberta Casas',
            'email' => 'roberta.casas@flowbite.com',
            'password' => Hash::make('12345678'),
            'isEmployee' => false,
        ],
        [
            'name' => 'Michael Gough',
            'email' => 'michael.gough@flowbite.com',
            'password' => Hash::make('12345678'),
            'isEmployee' => false,
        ]];
        User::insert($users);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'isEmployee' => false,
        // ]);
    }
}
