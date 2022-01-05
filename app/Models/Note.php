<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function files(){
        return $this->hasMany(File::Class);
    }

    public function exams(){
        return $this->belongsToMany(Exam::Class, 'exam_note');
    }

    public function subject(){
        return $this->belongsTo(Subject::Class);
    }
}
