<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'academicYear', 'studentId', 'subjectId', 'gradeValue',
    ];

    public function studentRecord()
    {
        return $this->belongsTo(StudentRecord::class, 'studentId', 'id');
    }

    public function curricula()
    {
        return $this->belongsTo(Curriculum::class, 'subjectId', 'id');
    }
}
