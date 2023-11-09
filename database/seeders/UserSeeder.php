<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = date('Y');
        $randomString = \Faker\Factory::create()->unique()->regexify('[A-Z0-9]{5}'); // Generates a unique random string of 5 characters

        for ($i = 1; $i <= 5; $i++) {
            $userId = $year . '-' . $randomString . '-' . 'ADMIN';
            User::create([
                'user_id' => $userId,
                'email' => \Faker\Factory::create()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }

        for ($i = 6; $i <= 15; $i++) {
            $userId = $year . '-' . $randomString . '-' . 'S';
            User::create([
                'user_id' => $userId,
                'email' => \Faker\Factory::create()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }

        for ($i = 16; $i <= 25; $i++) {
            $userId = $year . '-' . $randomString . '-' . 'F';
            User::create([
                'user_id' => $userId,
                'email' => \Faker\Factory::create()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }

        for ($i = 1; $i <= 25; $i++) {
            UserAddress::create([
                'userId' => $i,
                'address' => \Faker\Factory::create()->unique()->streetAddress(),
                'barangay' => \Faker\Factory::create()->unique()->streetName(),
                'cityId' => \Faker\Factory::create()->randomElement(range(1, 30)),
            ]);
        }
    }
}
