<?php

namespace Database\Seeders;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\TypeSeeder;
use Database\Seeders\TechnologySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        ProjectSeeder::class, 
        TypeSeeder::class,
        TechnologySeeder::class
    ]);
    }
}
