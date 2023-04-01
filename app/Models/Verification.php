<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $table = "verifications";
    protected $fillable = ["user_id", "id_number", "card_image_url", "uuid","id_type"];

}
