<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityMunicipality extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'city', 'zip', 'state', 'region',
    ];

    public function city()
    {
        return $this->hasMany(UserAddress::class, 'cityId', 'id');
    }
}
