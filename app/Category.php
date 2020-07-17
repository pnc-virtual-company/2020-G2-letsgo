<?php

namespace App;
use App\Event;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    public function events(){
        return $this->hasMany(Event::class);
    }
}
