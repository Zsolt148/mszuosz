<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Budai Zsolt',
                'email' => 'b.zsolt148@gmail.com',
                'role' => 'admin',
                'password' => '$2y$10$RTKomZaszHHGhelMjszMIeyn01vqv4dMe0GKKVizXtuDwZ0DN8NCC',
            ],
            [
                'name' => 'Kolonics Krisztián',
                'email' => 'kolonics@kvsc.info',
                'role' => 'admin',
                'password' => '$2y$10$7mKZQEHV9hO1K05U9K8U7eEknR1Fi18Yku4qk9r/jwQZUtYscuV7.',
            ],
        ];

        foreach($users as $data) {
            User::firstOrCreate(
                [
                    'email' => $data['email']
                ], [
                    'name' => $data['name'],
                    'role' => $data['role'],
                    'password' => $data['password'],
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
