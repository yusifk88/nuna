<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    use HasFactory;
    protected $fillable = ["wedding_id","name","phone_number","email"];
    protected $table = "reservations";

}
