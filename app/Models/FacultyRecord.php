<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'userId', 'firstName', 'middleName', 'lastName', 'suffix', 'gender', 'age', 'birthday',
    ];
}
