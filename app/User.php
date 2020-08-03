<?php

namespace App;
use App\Event;
use App\Join;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
// implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.e
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','birth','city','sex', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // protected $with = ['joins'];

    public function events(){
        return $this->hasMany(Event::class,'owner_id');
    }

    public function joins(){
        return $this->hasMany(Join::class);
    }
       
}
