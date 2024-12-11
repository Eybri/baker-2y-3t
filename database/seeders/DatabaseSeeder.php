<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);

    //     $this->call(EmployeeCrudsTableSeeder::class);
    // }
    public function run(): void
    {
        Category::factory()->create([
            [
                'name' => 'Electronics',
                'description' => 'Devices, gadgets and more.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Books',
                'description' => 'Various genres of books.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clothing',
                'description' => 'Men, Women and Kids clothing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
