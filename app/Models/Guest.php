<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public $fillable = ['user_id','name','email','phone'];

}
