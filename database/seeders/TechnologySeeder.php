<?php

namespace Database\Seeders;

use App\Models\Technology;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies=['HTML', 'CSS', 'Sass/SCSS', 'JavaScript', 'Vue', 'npm', 'PHP', 'Laravel', 'MySQL', 'Git', 'GitHub'];

        foreach($technologies as $technology){
            $newTechnology= new Technology();
            $newTechnology->name =$technology;
            $newTechnology->slug= Str::slug($newTechnology->name, '-');
            $newTechnology->save();
        };

    }
}
