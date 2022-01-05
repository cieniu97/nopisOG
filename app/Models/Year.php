<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Year extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function field(){
        return $this->belongsTo(Field::class);
    }
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
    public function users(){
        return $this->belongsToMany(User::Class, 'user_year');
    }
}
