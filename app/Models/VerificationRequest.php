<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    use HasFactory;

    protected $table = "verifications";

    public function user (){

        return $this->belongsTo(AppUser::class,"id", "user_id");

    }

}
