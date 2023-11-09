<?php

namespace Database\Seeders;

use App\Models\StudentRecord;
use DateTime;
use Illuminate\Database\Seeder;

class StudentRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 6; $i <= 15; $i++) {
            // Generate a random date of birth within a 5 to 15-year range
            $minDOB = strtotime('-15 years');
            $maxDOB = strtotime('-5 years');
            $randomDOB = rand($minDOB, $maxDOB);
            $birthdate = date('Y-m-d', $randomDOB);

            // Calculate the age based on the generated date of birth
            $birthdate = new DateTime($birthdate);
            $currentDate = new DateTime();
            $age = $birthdate->diff($currentDate)->y;

            StudentRecord::create([
                "userId" => $i,
                "firstName" => \Faker\Factory::create()->firstName,
                "middleName" => \Faker\Factory::create()->firstName,
                "lastName" => \Faker\Factory::create()->lastName,
                "suffix" => \Faker\Factory::create()->randomElement(['', 'JR']),
                "gender" => \Faker\Factory::create()->randomElement(['M', 'F']),
                "age" => $age,
                "birthday" => $birthdate,
                "gradeId" => \Faker\Factory::create()->randomElement([1, 2, 3, 4, 5, 6, 7]),
            ]);
        }
    }
}
