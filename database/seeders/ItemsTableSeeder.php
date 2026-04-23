<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'status' => 'active',
                'name' => 'One',
                'description' => 'Category for service-related items.',
                'image' => 'service.jpg',
                'category_id' => 1,
                'url' => 'one',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'active',
                'name' => 'Two',
                'description' => 'Category for rental items.',
                'image' => 'rent.jpg',
                'category_id' => 1,
                'url' => 'two',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'active',
                'name' => 'Three',
                'description' => 'Category for support-related items.',
                'image' => 'support.jpg',
                'category_id' => 2,
                'url' => 'three',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}