<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "person_id",
        "agents_id",
        "exam_at"
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function agent(){
        return $this->belongsTo(User::class, 'agent_id');
    }
}
