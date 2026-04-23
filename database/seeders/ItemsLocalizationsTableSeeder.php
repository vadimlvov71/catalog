<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsLocalizationsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get category ids by name (assuming names are unique and seeded already)
        $items = DB::table('items')->whereIn('name', [
            'One', 'Two', 'Three'
        ])->pluck('id', 'name');
            echo "<pre>";
            print_r($items);
        $localizations = [
            // Service
            [
                'item_id' => $items['One'],
                'lang' => 'en',
                'name' => 'Item Service 1',
                'description' => 'Category for service-related items.',
            ],
            [
                'item_id' => $items['One'],
                'lang' => 'ru',
                'name' => 'Товар Услуги 1',
                'description' => 'Категория для сервисных услуг.',
            ],
            [
                'item_id' => $items['One'],
                'lang' => 'ua',
                'name' => 'Товар Послуги 1',
                'description' => 'Категорія для сервісних послуг.',
            ],

            // Rent
            [
                'item_id' => $items['Two'],
                'lang' => 'en',
                'name' => 'Item Rent',
                'description' => 'Category for rental items.',
            ],
            [
                'item_id' => $items['Two'],
                'lang' => 'ru',
                'name' => 'Товар Аренда',
                'description' => 'Категория для аренды.',
            ],
            [
                'item_id' => $items['Two'],
                'lang' => 'ua',
                'name' => 'Товар Оренда',
                'description' => 'Категорія для оренди.',
            ],

            // Support
            [
                'item_id' => $items['Three'],
                'lang' => 'en',
                'name' => 'Item Support',
                'description' => 'Category for support-related items.',
            ],
            [
                'item_id' => $items['Three'],
                'lang' => 'ru',
                'name' => 'Товар Поддержка',
                'description' => 'Категория для поддержки.',
            ],
            [
                'item_id' => $items['Three'],
                'lang' => 'ua',
                'name' => 'Товар Підтримка',
                'description' => 'Категорія для підтримки.',
            ],
        ];

        foreach ($localizations as $loc) {
            DB::table('items_localizations')->insert([
                'name' => $loc['name'],
                'description' => $loc['description'],
                'item_id' => $loc['item_id'],
                'lang' => $loc['lang'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}