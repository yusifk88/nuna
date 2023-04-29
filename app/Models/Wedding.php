<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;
    protected $table="wedding";

    public function user(){
        return $this->hasOne(AppUser::class,"id","user_id");
    }
}
