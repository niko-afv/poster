<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class User extends Authenticatable
{
    use Notifiable, SyncableGraphNodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function accounts(){
        return $this->hasMany(Account::class, 'user_id', 'id');
    }

    public function groups(){
        return $this->hasMany(Group::class, 'user_id', 'id');
    }

    public function scopeByToken($query, $token){
        return $query->where('token', $token);
    }
}
