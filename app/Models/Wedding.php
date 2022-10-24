<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{


    use HasFactory;

    protected $table = "wedding";
    protected $fillable = ["user_id", "bride_name", "bride_phone_number", "bride_email", "groom_name", "groom_phone_number",
        "groom_email", "tag", "rsv_phone_number", "rsv_person", "location", "coordinates", "date_time", "photo_one", "photo_two",
        "photo_three", "photo_four", "zoom_link", "youtube_link", "public"];

    protected $casts = [
        "public" => "bool",
        "archived" => "bool"
    ];

    public function items(){

        return $this->hasMany(WishList::class,"wadding_id","id");

    }


}
