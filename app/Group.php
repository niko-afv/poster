<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable= ['name', 'description', 'user_id'];


    public function accounts(){
        return $this->belongsToMany(Account::class, 'account_has_groups','group_id');
    }
}
