<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sell extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "person_id",
        "status"
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function items(){
        return $this->hasMany(SellItem::class);
    }
}
