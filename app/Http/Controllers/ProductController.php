<?php

namespace App\Http\Controllers;

use App\Models\advert;
use App\Models\product;
use App\Models\category;
use App\Models\sideadvert;
use App\Models\subcategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

    public function showManageProduct()
    {
        return view($this->admin . '.dashboard.manageproduct', [
            'products' => product::latest('id')->paginate(20)
            // ->filter(request(['searchbtn']))->get()
        ]);
    }

    //show add product

    public function showAddProduct()
    {
        $subcategories = subcategory::where('active', 'yes')->get(); // Retrieve categories
        $suppliers = Supplier::whereNotNull('id')->get();

        return view($this->admin . '.dashboard.addproduct', compact('subcategories','suppliers'));
    }

    //    controller to show store the product

    public function storeProduct(Request $request)
    {
        $formAddProduct = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id', // Validate the selected category
            'supplier_id' => 'required|exists:suppliers,id', // Validate the selected supplier
            'name' => ['required', Rule::unique('products', 'name')],
            'price' => 'nullable|numeric',
            'colors' => 'nullable',
            'priceranges' => 'nullable',
            'Active' => 'required|in:yes,no',
            'featured' => 'required|in:yes,no',
            'numberunit' => 'required',
            'info' => 'nullable',
            'description' => 'nullable',
            'information' => 'nullable',
            'outlines' => 'nullable',
            'outline_tags' => 'nullable',
            'discount' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $formAddProduct['image'] = $request->file('image')->store('images', 'public');
        }
        DB::table('products')->insert($formAddProduct);
        return redirect($this->admin)->with('success', 'Products Added Successfully');
    }



    // contoller to show edit product page
    public function showEditProduct(product $product)
    {

        $subcategories = subcategory::where('active', 'yes')->get();
        $suppliers = Supplier::whereNotNull('id')->get();

        return view($this->admin . '.dashboard.editproduct', compact('subcategories', 'product','suppliers'));
    }



    // controller to update category
    //    controller to show store the product

    public function updateProduct(Request $request, product $product)
    {
        $formAddProduct = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id', // Validate the selected category
            'supplier_id' => 'required|exists:suppliers,id', // Validate the selected supplier
            'name' => 'required',
            'price' => 'nullable',
            'colors' => 'nullable',
            'priceranges' => 'nullable',
            'Active' => 'required',
            'featured' => 'required',
            'numberunit' => 'required',
            'info' => 'nullable',
            'description' => 'nullable',
            'information' => 'nullable',
            'outlines' => 'nullable',
            'outline_tags' => 'nullable',
            'discount' => 'nullable',


        ]);

        if ($request->hasFile('image')) {
            $formAddProduct['image'] = $request->file('image')->store('images', 'public');
        }
        DB::table('products')->where('id', $product->id)->update($formAddProduct);
        return back()->with('success', 'Product updated successfully');
    }


    //   controller to delete category
    public function deleteProduct(product $product)
    {
        $product->delete();
        return redirect($this->admin)->with('danger', 'Product Deleted Successfully');
    }
}
