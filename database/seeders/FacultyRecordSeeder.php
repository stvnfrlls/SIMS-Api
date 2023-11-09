<?php

namespace Database\Seeders;

use App\Models\FacultyRecord;
use DateTime;
use Illuminate\Database\Seeder;

class FacultyRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 16; $i <= 25; $i++) {
            // Generate a random date of birth within a 5 to 15-year range
            $minDOB = strtotime('-40 years');
            $maxDOB = strtotime('-25 years');
            $randomDOB = rand($minDOB, $maxDOB);
            $birthdate = date('Y-m-d', $randomDOB);

            // Calculate the age based on the generated date of birth
            $birthdate = new DateTime($birthdate);
            $currentDate = new DateTime();
            $age = $birthdate->diff($currentDate)->y;

            FacultyRecord::create([
                "userId" => $i,
                "firstName" => \Faker\Factory::create()->firstName,
                "middleName" => \Faker\Factory::create()->firstName,
                "lastName" => \Faker\Factory::create()->lastName,
                "suffix" => \Faker\Factory::create()->randomElement(['', 'JR']),
                "gender" => \Faker\Factory::create()->randomElement(['M', 'F']),
                "age" => $age,
                "birthday" => $birthdate,
            ]);
        }
    }
}
