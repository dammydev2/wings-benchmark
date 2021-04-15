<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wingsdeposit extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'amount', 'wings_id'];
}
