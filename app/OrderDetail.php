<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [  'orderid', 'menuid', 'qty', 'specialrequest'];
    public function Order()
    {
        return $this->belongsTo('App\Order','orderid');
    }
    public function VendorMenus()
    {
        return $this->belongsTo('App\VendorMenu','menuid');
    }
}
