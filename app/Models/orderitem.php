<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitem extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(order::class,'order_id');
}

public function supplier(){
    return $this->belongsTo(supplier::class,'order_id');
}

}
