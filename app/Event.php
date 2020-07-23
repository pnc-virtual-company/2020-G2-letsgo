<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Join;
class Event extends Model
{ 
    protected $fillable = [
        'category','title','startDate','endDate','startTime', 'endTime', 'picture','description',
    ];

    
    public function category(){
        return $this->belongsTo(Category::class,'cate_id');
    }
    public function User(){
        return $this->belongsToMany('App\User');
    }
    public function joins(){
        return $this->hasMany(Join::class);
    }

}
