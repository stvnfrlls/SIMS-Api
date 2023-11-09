<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'academicYear', 'studentId', 'timeIn', 'timeOut', 'status',
    ];

    public function studentRecord()
    {
        return $this->belongsTo(StudentRecord::class, 'studentId', 'id');
    }
}
