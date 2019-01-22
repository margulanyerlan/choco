<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    protected $fillable = ['name','rull_id','type','charge'];
}
