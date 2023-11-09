<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use Illuminate\Database\Seeder;

class GradeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GradeLevel::insert([
            [
                "gradeLevel" => 0,
                'gradeLabel' => 'Kinder',
                'sectionName' => \Faker\Factory::create()->unique()->state(),
            ],
            [
                "gradeLevel" => 1,
                'gradeLabel' => 'Grade 1',
                'sectionName' => \Faker\Factory::create()->unique()->state(),
            ],

            [
                "gradeLevel" => 2,
                'gradeLabel' => 'Grade 2',
                'sectionName' => \Faker\Factory::create()->unique()->state(),
            ],
            [
                "gradeLevel" => 3,
                'gradeLabel' => 'Grade 3',
                'sectionName' => \Faker\Factory::create()->unique()->state(),
            ],
            [
                "gradeLevel" => 4,
                'gradeLabel' => 'Grade 4',
                'sectionName' => \Faker\Factory::create()->unique()->state(),
            ],
            [
                "gradeLevel" => 5,
                'gradeLabel' => 'Grade 5',
                'sectionName' => \Faker\Factory::create()->unique()->state(),
            ],
            [
                "gradeLevel" => 6,
                'gradeLabel' => 'Grade 6',
                'sectionName' => \Faker\Factory::create()->unique()->state(),
            ],
        ]);
    }
}
