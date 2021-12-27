<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::Class);
    }

    public function subjects(){
        return $this->hasMany(Subject::Class);
    }
}
