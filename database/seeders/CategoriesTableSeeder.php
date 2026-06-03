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
                'status_index_page_show' => 'show',
                'status_index_page_avatar_show' => 'show',
                'name' => 'Service',
                'description' => 'Category for service-related items.',
                'image' => 'service.jpg',
                'url' => 'service',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'active',
                'status_index_page_show' => 'show',
                'status_index_page_avatar_show' => 'show',
                'name' => 'Type of websites',
                'description' => 'Type of websites.',
                'image' => 'rent.jpg',
                'url' => 'type_of_websites',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'active',
                'status_index_page_show' => 'show',
                'status_index_page_avatar_show' => 'show',
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