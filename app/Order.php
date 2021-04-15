<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['type', 'item', 'address', 'amount', 'name', 'cus_phone', 'email', 'ben_name', 'ben_phone', 'pick_address', 'delivery_type', 'order_id', 'pick_time'];
}
