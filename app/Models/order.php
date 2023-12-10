<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable =['customer_id','name','email','number','street','division','city','tracking_no','Order_number','payment_mode','Order_status','payment_id','shipping_fee','calculated_total','orderdate'];



public function orderitems(){
    return $this->hasMany(orderitem::class,'order_id');
}

public function deliveries(){
    return $this->hasMany(delivery::class,'order_id');
}


public function customer(){
    return $this->belongsTo(Customer::class,'customer_id');
}

}
