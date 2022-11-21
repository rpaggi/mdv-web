<?php

namespace App\Models;

use Guiliredu\BrazilianCityMigrationSeed\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
      'name',
      'nickname',
      'document',
      'address',
      'address_city_id',
      'address_reference',
      'phone',
      'age',
      'acs',
    ];

    public function city(){
        return $this->belongsTo(City::class, 'address_city_id', 'id');
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }
}
