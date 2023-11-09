<?php

namespace Database\Seeders;

use App\Models\AcademicRecord;
use App\Models\Curriculum;
use App\Models\StudentRecord;
use Illuminate\Database\Seeder;

class AcademicRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $students = StudentRecord::where("gradeId", "1")->get();
        $students = StudentRecord::all();
        $subjects = Curriculum::all();

        foreach ($subjects as $subject) {
            for ($i = 1; $i <= 4; $i++) {
                foreach ($students as $student) {
                    AcademicRecord::create([
                        "academicYear"  => '2023 - 2024',
                        "studentId" => $student->id,
                        "gradeQuarter" => $i,
                        "subjectId" => $subject->id,
                        "gradeValue" => \Faker\Factory::create()->randomElement(range(75, 90)),
                    ]);
                }
            }
        }
    }
}
