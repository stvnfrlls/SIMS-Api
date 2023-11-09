<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradeLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'gradeLevel', 'gradeLabel'
    ];

    public function studentRecord()
    {
        return $this->hasMany(StudentRecord::class, 'gradeId', 'id');
    }

    public function advisoryClasses()
    {
        return $this->hasMany(AdvisoryClass::class, 'gradeId', 'id');
    }

    public function facultySchedule()
    {
        return $this->hasMany(FacultySchedule::class, 'gradeId', 'id');
    }
}
