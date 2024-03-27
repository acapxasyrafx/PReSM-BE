<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'emailId' => 'test@example.com',
            'password' => '$2y$12$4EqxXofhwWY/OZbMxMnJTuADG5d8.kxlS1cTfLHgg8YMWu69UF1h6',
        ]);
    }
}
