<?php

namespace App;
use App\Category;
use App\Join;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function joins(){
        return $this->hasMany(Join::class);
    }

}
