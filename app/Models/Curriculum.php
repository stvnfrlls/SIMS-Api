<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculum extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subjectCode', 'subjectName', 'minYearLevel', 'maxYearLevel',
    ];

    public function academicRecord()
    {
        return $this->hasMany(AcademicRecord::class, 'subjectId', 'id');
    }

    public function facultySchedule()
    {
        return $this->hasMany(FacultySchedule::class, 'subjectId', 'id');
    }
}
