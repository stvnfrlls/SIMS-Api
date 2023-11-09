<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultySchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'academicYear', 'facultyId', 'subjectId', 'gradeId', 'startTime', 'endTime',
    ];
}
