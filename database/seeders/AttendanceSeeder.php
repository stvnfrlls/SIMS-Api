<?php

namespace Database\Seeders;

use App\Models\AttendanceRecord;
use App\Models\StudentRecord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = StudentRecord::all();

        foreach ($students as $student) {
            // Generate attendance records for 10 days
            for ($day = 0; $day < 10; $day++) {
                // Calculate the date for the current day
                $currentDate = Carbon::now()->subDays($day);

                // Skip weekends (Saturday and Sunday)
                if ($currentDate->isWeekend()) {
                    continue;
                }

                // Set the start time between 7 AM and 8 AM
                $startTime = $currentDate->setTime(rand(7, 8), rand(0, 59), 0);

                // Set the end time between 1 hour and 5 hours later
                $endTime = $startTime->copy()->addHours(rand(1, 5));

                // Calculate attendance status
                $attendanceStatus = $this->calculateStatus($startTime);

                // Create an attendance record
                AttendanceRecord::create([
                    "academicYear" => "2023-2024",
                    "studentId" => $student->id,
                    "timeIn" => $startTime,
                    "timeOut" => $endTime,
                    "status" => $attendanceStatus,
                ]);
            }
        }
    }

    private function calculateStatus($startTime)
    {
        return $startTime->hour > 7 ? 'LATE' : 'PRESENT';
    }
}
