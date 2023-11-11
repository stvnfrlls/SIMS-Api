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
        $this->call(UserSeeder::class);
        $this->call(GradeLevelSeeder::class);

        $this->call(FacultyRecordSeeder::class);
        $this->call(StudentRecordSeeder::class);

        $this->call(AcademicRecordSeeder::class);
        $this->call(FacultyScheduleSeeder::class);
        $this->call(AdvisoryClassSeeder::class);
    }
}
