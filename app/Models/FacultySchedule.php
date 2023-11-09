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

    public function facultyRecord()
    {
        return $this->belongsTo(facultyRecord::class, 'facultyId', 'id');
    }

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'gradeId', 'id');
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'subjectId', 'id');
    }
}
