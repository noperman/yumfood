<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function Orders()
    {
        return $this->hasMany('App\OrderDetail','orderid');
    }
}
