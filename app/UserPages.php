<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPages extends Model
{
    protected $fillable = ['id', 'name', 'category', 'photo'];
}
