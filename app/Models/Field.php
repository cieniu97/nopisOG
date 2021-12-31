<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function university(){
        return $this->belongsTo(University::class);
    }
    public function years(){
        return $this->hasMany(Year::class);
    }
}
