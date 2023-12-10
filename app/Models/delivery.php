<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery extends Model
{
    use HasFactory;

    // relation with the delivery man
    public function deliveryman(){
        return $this->belongsTo(Deliveryman::class,'deliveryman_id');

}

 // relation with the delivery man
 public function order(){
    return $this->belongsTo(order::class,'order_id');

}
}
