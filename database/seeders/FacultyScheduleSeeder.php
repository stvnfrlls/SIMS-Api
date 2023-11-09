<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use App\Models\FacultyRecord;
use App\Models\FacultySchedule;
use App\Models\GradeLevel;
use Illuminate\Database\Seeder;

class FacultyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradeLevels = GradeLevel::all();
        $faculties = FacultyRecord::all();
        $subjects = Curriculum::all();

        foreach ($gradeLevels as $gradeLevel) {
            foreach ($faculties as $faculty) {
                foreach ($subjects as $subject) {
                    $startTime = \Faker\Factory::create()->dateTimeBetween('9:00', '17:00')->format('H:i');
                    $endTime = \Faker\Factory::create()->dateTimeBetween($startTime, '17:00')->format('H:i');

                    FacultySchedule::create([
                        "academicYear" => '2023-2024',
                        'facultyId' => $faculty->id,
                        'subjectId' => $subject->id,
                        'gradeId' => $gradeLevel->id,
                        'startTime' => $startTime,
                        'endTime' => $endTime,
                    ]);
                }
            }
        }
    }
}
