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
      'addess_city_id',
      'addess_reference',
      'phone',
      'age',
      'acs',
    ];

    public function city(){
        return $this->belongsTo(City::class, 'address_city_id', 'id');
    }
}
