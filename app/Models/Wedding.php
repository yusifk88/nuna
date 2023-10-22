<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wedding extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="wedding";

    public function user(){
        return $this->hasOne(AppUser::class,"id","user_id");
    }

    public function totalAmount(){

        return $this->hasOne(WeddingContribution::class,"wedding_id","id")->where("success",1);

    }

}
