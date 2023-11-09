<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'userId', 'firstName', 'middleName', 'lastName', 'suffix', 'gender', 'age', 'birthday', 'gradeId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function academicRecord()
    {
        return $this->hasMany(AcademicRecord::class, 'studentId', 'id');
    }

    public function attendanceRecord()
    {
        return $this->hasMany(AttendanceRecord::class, 'studentId', 'id');
    }

    public function gradeLevels()
    {
        return $this->belongsTo(GradeLevel::class, 'gradeId', 'id');
    }
}
