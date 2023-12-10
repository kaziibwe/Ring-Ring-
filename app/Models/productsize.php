<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsize extends Model
{
    use HasFactory;
    protected $fillable =['itemsizes','itemprice'];

    public function product(){
        return $this->belongsTo(product::class,'product_id');
}
}
