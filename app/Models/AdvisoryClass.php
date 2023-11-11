<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvisoryClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'academicYear', 'gradeId', 'facultyId',
    ];

    public function facultyRecord()
    {
        return $this->belongsTo(FacultyRecord::class, 'facultyId', 'id');
    }

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'gradeId', 'id');
    }
}
