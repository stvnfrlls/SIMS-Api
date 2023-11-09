<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curriculum::insert([
            [
                "subjectCode" => "CBA",
                "subjectName" => "Character Building Activities",
                "minYearLevel" => "0",
                "maxYearLevel" => "3",
            ],
            [
                "subjectCode" => "MT",
                "subjectName" => "Mother Tongue",
                "minYearLevel" => "1",
                "maxYearLevel" => "3",
            ],
            [
                "subjectCode" => "EP",
                "subjectName" => "Edukasyon sa Pagpapakatao",
                "minYearLevel" => "1",
                "maxYearLevel" => "3",
            ],
            [
                "subjectCode" => "FIL",
                "subjectName" => "Filipino",
                "minYearLevel" => "0",
                "maxYearLevel" => "6",
            ],
            [
                "subjectCode" => "ENG",
                "subjectName" => "English",
                "minYearLevel" => "0",
                "maxYearLevel" => "6",
            ],
            [
                "subjectCode" => "MTH",
                "subjectName" => "Math",
                "minYearLevel" => "0",
                "maxYearLevel" => "6",
            ],
            [
                "subjectCode" => "SCI",
                "subjectName" => "Science",
                "minYearLevel" => "0",
                "maxYearLevel" => "6",
            ],
            [
                "subjectCode" => "AP",
                "subjectName" => "Araling Panlipunan",
                "minYearLevel" => "0",
                "maxYearLevel" => "6",
            ],
            [
                "subjectCode" => "PE",
                "subjectName" => "MAPEH",
                "minYearLevel" => "0",
                "maxYearLevel" => "6",
            ],
            [
                "subjectCode" => "EPP",
                "subjectName" => "Edukasyong Pantahanan at Pangkabuhayan (EPP)",
                "minYearLevel" => "4",
                "maxYearLevel" => "6",
            ],
            [
                "subjectCode" => "ESP",
                "subjectName" => "Edukasyon sa Pagpapakatao (EsP)",
                "minYearLevel" => "1",
                "maxYearLevel" => "3",
            ],
        ]);
    }
}
