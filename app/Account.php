<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['source_id', 'name', 'image', 'user_id', 'account_type_id'];
}
