<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'rider_id'];
}
