<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "wish_list";
    protected $fillable = ["user_id", "wedding_id", "name","type", "description", "img_url", "target_amount", "amount_contributed", "visible"];
    protected $casts = [
        "visible" => "bool"
    ];
}
