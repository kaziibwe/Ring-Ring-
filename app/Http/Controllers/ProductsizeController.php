<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productsize;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductsizeController extends Controller
{
      //
     // declaring the variable for this moment
     protected $admin;

     public function __construct()
     {
         // Define the $admin variable here
         $this->admin = 'admin';
     }


  //show manage product

     public function showManageProductSize()
     {
         return view($this->admin . '.dashboard.manageproductsize',[
            'productsizes'=>productsize::latest('id')->paginate(20)
        ]);
     }

        //show add product

        public function showAddProductSize()
        {
            $products = Product::whereNull('price')->get();  // return null or empty
            return view($this->admin . '.dashboard.addproductsize', compact('products'));
        }


//    controller to show store the product
public function storeProductSize(Request $request){
    $formAddProduct = $request->validate([
        'product_id' => 'required|exists:products,id', // Validate the selected product
        'itemsizes'=> 'required',
        'itemprice'=>'required|numeric',
        'unities'=>'nullable|numeric',
        'itemcolors'=>'nullable',

    ]);

    DB::table('productsizes')->insert($formAddProduct);
    return redirect($this->admin )->with('success','Product Size Added Successfully');
   }




       // contoller to show edit product page
       public function showEditProductSize(productsize $productsize){
        $products = Product::whereNull('price')->get();  // return null or empty
        return view($this->admin . '.dashboard.editproductsize', compact('products', 'productsize'));
    }

       //    controller to show store the product

   public function updateProductSize(Request $request, productsize $productsize){
    $formAddProductSize = $request->validate([
        'product_id' => 'required|exists:products,id', // Validate the selected category
        'itemsizes'=> 'required',
        'itemprice'=>'required',
        'unities'=>'nullable',
        'itemcolors'=>'nullable',


    ]);
    DB::table('productsizes')->where('id', $productsize->id)->update($formAddProductSize);
    return back()->with('success','Product Size updated successfully');

   }

      //   controller to delete category
  public function deleteProductSize(productsize $productsize)
  {
      $productsize->delete();
      return redirect($this->admin)->with('danger', 'Product Size Deleted Successfully');
  }
}


