<?php

namespace Database\Seeders;

use App\Models\AdvisoryClass;
use Illuminate\Database\Seeder;

class AdvisoryClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 7; $i++) {
            AdvisoryClass::create([
                "academicYear" => "2023-2024",
                "gradeId" => $i,
                "facultyId" => $i,
            ]);
        }
    }
}
