<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingContribution extends Model
{
    use HasFactory;

    protected $table = "wedding_contributions";
    protected $fillable = ["name", "email", "phone_number", "amount", "checkout_token", "success","message","wedding_id","transaction_id"];
    protected $casts = [
        "success" => "boolean"
    ];

}
