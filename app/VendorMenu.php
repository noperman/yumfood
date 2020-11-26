<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorMenu extends Model
{
    public function Vendor()
    {
        return $this->belongsTo('App\Vendor','vendorid','id');
    }
    public function OrderDetails()
    {
        return $this->hasMany('App\OrderDetail','menuid');
    }
}
