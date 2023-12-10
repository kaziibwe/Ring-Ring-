<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable =['name','image','price','colors','sizes','Active','featured','numberunit','info','description','information','outlines','outline_tags','priceranges','discount'];




    public function scopeFilter($query,  array $filters) {
        // if($filters['tag'] ?? false) {
        //       $query->where('tags','like', '%' .request('tag') . '%');
        // }

        if($filters['searchbtn'] ?? false) {
            $query->where('name','like', '%' .request('searchbtn') . '%')
                  ->orWhere('price	','like', '%' .request('searchbtn') . '%')
                  ->orWhere('description	','like', '%' .request('searchbtn') . '%')
                  ->orWhere('information','like', '%' .request('searchbtn') . '%');
      }
    }




    public function subcategory(){
        return $this->belongsTo(subcategory::class,'subcategory_id');
}

public function productgalleries(){
    return $this->hasMany(productgallery::class,'product_id');
}

public function productsizes(){
    return $this->hasMany(productsize::class,'product_id');
}


public function supplier(){
    return $this->belongsTo(supplier::class,'supplier_id');
}


}
