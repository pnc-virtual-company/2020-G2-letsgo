<?php

namespace App;
use App\User;
use App\Event;
use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
