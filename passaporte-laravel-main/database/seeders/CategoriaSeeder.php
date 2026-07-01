<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insertOrIgnore([
            ['name' => 'Tecnologia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Música', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Negócios', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Esportes', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
