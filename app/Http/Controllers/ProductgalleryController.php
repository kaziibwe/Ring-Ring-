<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productgallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductgalleryController extends Controller
{
    //


      // declaring the variable for this moment
      protected $admin;

      public function __construct()
      {
          // Define the $admin variable here
          $this->admin = 'admin';
      }


   //show managegory

      public function showManageProductGallery()
      {
          return view($this->admin . '.dashboard.manageproductgarallery',[
            'productgalleries'=>productgallery::latest('id')->paginate(6)
        ]);
      }
// controller to show  add product gallery
      public function  showAddProductGallery()
      {

        $products = product::where('active', 'yes')->get(); // Retrieve categories

        return view($this->admin.'.dashboard.addproductgarallery',compact('products'));
      }

    //   controller to add the product gallery

    public function storeProductGallery(Request $request){
        $AddProductGallery = $request->validate([
        'product_id' => 'required|exists:products,id', // Validate the selected category
        ]);
        if($request->hasFile('image')){
            $AddProductGallery['image']=$request->file('image')->store('images','public');
        }
        DB::table('productgalleries')->insert($AddProductGallery);
        return redirect($this->admin)->with('success','Product Gallery Added Successfully');

    }
       // contoller to show edit product gallery page
       public function  showEditProductGallery(productgallery $productgallery){

        $products = product::where('active', 'yes')->get();
        return view($this->admin . '.dashboard.editproductgallery', compact('products', 'productgallery'));
    }


    // controller to update product gallery
    public function updateProductGallery(Request $request,productgallery $productgallery){
        $AddProductGallery = $request->validate([
        'product_id' => 'required|exists:products,id', // Validate the selected category
        ]);
        if($request->hasFile('image')){
            $AddProductGallery['image']=$request->file('image')->store('images','public');
        }
        DB::table('productgalleries')->where('id', $productgallery->id)->update($AddProductGallery);
        return back()->with('success','Product Gallery updated successfully');
    }



    public function  deleteProductGallery(productgallery $productgallery)
{
    $productgallery->delete();
    return redirect($this->admin)->with('danger', 'Productgallery Deleted Successfully');
}

}
