<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;


    // relationship btn category and subcategory
    public function category(){
        return $this->belongsTo(category::class,'category_id');
}

    public function products(){
        return $this->hasMany(product::class,'subcategory_id');
    }

}
