<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CityMunicipality;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        CityMunicipality::factory()->count(30)->create();

        $this->call(CurriculumSeeder::class);
        $this->call(GradeLevelSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StudentRecordSeeder::class);
        $this->call(FacultyRecordSeeder::class);
    }
}
