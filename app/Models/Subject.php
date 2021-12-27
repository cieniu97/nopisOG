<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function notes(){
        return $this->hasMany(Note::class);
    }
    public function exams(){
        return $this->hasMany(Subject::class);
    }
}
