<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Általános',
                'is_visible' => true
            ],
            [
                'name' => 'Sablon',
                'is_visible' => true
            ],
            [
                'name' => 'Szabályzat',
                'is_visible' => true
            ],
            [
                'name' => 'Jegyzőkönyv',
                'is_visible' => true
            ],
        ];

        foreach($types as $type) {
            DocumentType::firstOrCreate(
                [
                    'name' => $type['name']
                ], [
                    'is_visible' => $type['is_visible'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
