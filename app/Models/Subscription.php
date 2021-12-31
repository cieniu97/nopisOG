<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function users(){
        return $this->hasMany(User::Class);
    }

    public function subjects(){
        return $this->hasMany(Subject::Class);
    }
}
