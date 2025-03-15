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
        User::updateOrCreate(
            ['email' => 'test@example.com'], // Check if email already exists
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'), // You can set a default password
            ]
        );

        $this->call([
            ArticleSeeder::class, // Call ArticleSeeder
        ]);
    
    }
}
