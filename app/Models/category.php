<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'active', 'featured'];


// relation btn categories and subcategories
public function subcategories(){
    return $this->hasMany(subcategory::class,'category_id');
}



}
