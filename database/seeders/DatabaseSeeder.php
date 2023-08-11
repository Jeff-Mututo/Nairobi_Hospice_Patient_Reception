<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create a basic admin user with following credentials
            // email = 'admin@gmail.com'
            // password = admin1admin1
        $this->call(AdminUserSeeder::class);

        // Create a basic test user with following credentials
            // email = 'testuser1@gmail.com'
            // password = user1user1
        $this->call(TestUserSeeder::class);
    }
}
