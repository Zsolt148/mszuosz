<?php

namespace Database\Seeders;

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
        $data = [
            [
                'name' => 'Budai Zsolt',
                'email' => 'b.zsolt148@gmail.com',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => '$2y$10$RTKomZaszHHGhelMjszMIeyn01vqv4dMe0GKKVizXtuDwZ0DN8NCC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kolonics Krisztián',
                'email' => 'kolonics@kvsc.info',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => '$2y$10$7mKZQEHV9hO1K05U9K8U7eEknR1Fi18Yku4qk9r/jwQZUtYscuV7.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
