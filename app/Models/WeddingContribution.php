<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingContribution extends Model
{
    use HasFactory;
    protected $table = "wedding_contributions";

    public function wedding(){
        return $this->hasOne(Wedding::class,'id','wedding_id');
    }
}
