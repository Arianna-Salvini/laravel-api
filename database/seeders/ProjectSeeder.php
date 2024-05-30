<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i < 5; $i++) { 
            $project = new Project();
            $project->title = $faker->sentence(5, true) ;
            $project->slug= Str::slug($project->title, '-');
            $project->subtitle=$faker->sentence(13, true);
            $project->technology=$faker->word();
            $project->description=$faker->paragraph(1, true);
            $project->url=$faker->url();
            $project->image=$faker->imageUrl(600,300, 'Project',true, null, true, 'jpg');
            $project->save();
        }       
    } 
}
