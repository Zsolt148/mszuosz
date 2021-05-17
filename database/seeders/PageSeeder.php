<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Kezdőlap',
                'slug' => 'home',
                'body' => '',
            ],
            [
                'name' => 'Ranglisták',
                'slug' => 'ranks',
                'body' => '',
            ],
            [
                'name' => 'Bemutatkozás',
                'slug' => 'welcome',
                'body' => '',
            ],
            [
                'name' => 'Történet',
                'slug' => 'history',
                'body' => '',
            ],
            [
                'name' => 'Szervezeti működés',
                'slug' => 'association',
                'body' => '',
            ],
        ];

        Page::query()->insert($data);
    }
}
