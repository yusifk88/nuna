<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPin extends Model
{
    use HasFactory;
    protected $table ="user_pin";
    protected $fillable = ["code","phone_number",'used'];

    protected $casts =[
        "used"=>"boolean"
    ];
}
