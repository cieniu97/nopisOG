<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function notes(){
        return $this->hasMany(Note::class);
    }
    public function exams(){
        return $this->hasMany(Exam::class);
    }
    public function year(){
        return $this->belongsTo(Year::class);
    }
    public function users(){
        return $this->belongsToMany(User::Class, 'user_subject');
    }
}
