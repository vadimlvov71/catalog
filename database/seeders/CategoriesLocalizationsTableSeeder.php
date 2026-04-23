<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesLocalizationsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get category ids by name (assuming names are unique and seeded already)
        $categories = DB::table('categories')->whereIn('name', [
            'Service', 'Rent', 'Support'
        ])->pluck('id', 'name');

        $localizations = [
            // Service
            [
                'category_id' => $categories['Service'],
                'lang' => 'en',
                'name' => 'Service',
                'description' => 'Category for service-related items.',
            ],
            [
                'category_id' => $categories['Service'],
                'lang' => 'ru',
                'name' => 'Услуги',
                'description' => 'Категория для сервисных услуг.',
            ],
            [
                'category_id' => $categories['Service'],
                'lang' => 'ua',
                'name' => 'Послуги',
                'description' => 'Категорія для сервісних послуг.',
            ],

            // Rent
            [
                'category_id' => $categories['Rent'],
                'lang' => 'en',
                'name' => 'Rent',
                'description' => 'Category for rental items.',
            ],
            [
                'category_id' => $categories['Rent'],
                'lang' => 'ru',
                'name' => 'Аренда',
                'description' => 'Категория для аренды.',
            ],
            [
                'category_id' => $categories['Rent'],
                'lang' => 'ua',
                'name' => 'Оренда',
                'description' => 'Категорія для оренди.',
            ],

            // Support
            [
                'category_id' => $categories['Support'],
                'lang' => 'en',
                'name' => 'Support',
                'description' => 'Category for support-related items.',
            ],
            [
                'category_id' => $categories['Support'],
                'lang' => 'ru',
                'name' => 'Поддержка',
                'description' => 'Категория для поддержки.',
            ],
            [
                'category_id' => $categories['Support'],
                'lang' => 'ua',
                'name' => 'Підтримка',
                'description' => 'Категорія для підтримки.',
            ],
        ];

        foreach ($localizations as $loc) {
            DB::table('categories_localizations')->insert([
                'name' => $loc['name'],
                'description' => $loc['description'],
                'category_id' => $loc['category_id'],
                'lang' => $loc['lang'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}