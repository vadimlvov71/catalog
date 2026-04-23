<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'status' => 'active',
                'name' => 'Service',
                'description' => 'Category for service-related items.',
                'image' => 'service.jpg',
                'url' => 'service',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'active',
                'name' => 'Rent',
                'description' => 'Category for rental items.',
                'image' => 'rent.jpg',
                'url' => 'rent',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'active',
                'name' => 'Support',
                'description' => 'Category for support-related items.',
                'image' => 'support.jpg',
                'url' => 'support',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}