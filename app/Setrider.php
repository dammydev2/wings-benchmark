<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setrider extends Model
{
    protected $fillable = ['rider', 'order_id', 'name', 'destination', 'address', 'item'];
}
