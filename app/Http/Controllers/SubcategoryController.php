<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    //
     // declaring the variable for this moment
     protected $admin;

     public function __construct()
     {
         // Define the $admin variable here
         $this->admin = 'admin';
     }


  //show subcategory

     public function showManageSubcategory()
     {
         return view($this->admin . '.dashboard.managesubcategory',[
            'subcategories'=>subcategory::latest('id')->paginate(6)
        ]);
     }



   //show edit subcategory

//    public function showAddSubcategory()
//    {
//        return view($this->admin.'.dashboard.addsubcategory');
//    }


//
//route to show  add subcategory page
   public function showAddSubcategory()
{
    $categories = Category::where('active', 'yes')->get(); // Retrieve categories
    return view($this->admin . '.dashboard.addsubcategory', compact('categories'));
}




   //controller to add the subcategory

   public function storeSubcategory(Request $request){
    // dd($request->file('image'));
    $formAddSubcategory = $request->validate([
        'category_id' => 'required|exists:categories,id', // Validate the selected category
        'name'=> ['required', Rule::unique('subcategories','name')],
        // 'name' => 'required|string|max:255',
        'Active' => 'required|in:yes,no',
        'Featured' => 'required|in:yes,no',
    ]);

    if($request->hasFile('image')){
        $formAddSubcategory['image']=$request->file('image')->store('images','public');
    }
    // php artisan storage:link    run the command in the teminal to link the storage to public

    DB::table('subcategories')->insert($formAddSubcategory);
    return redirect($this->admin)->with('success','Subcategory Added Successfully');

  }



     // contoller to show edit subcategory page
     public function showEditSubcategory(subcategory $subcategory){

        $categories = Category::where('active', 'yes')->get();
        return view($this->admin . '.dashboard.editsubcategory', compact('categories', 'subcategory'));
    }




//   controller to update subcategory
public function updateSubcategory(Request $request ,subcategory $subcategory ){
    $formAddSubcategory = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name'=> 'required',
        'Active' => 'required',
        'Featured' => 'required',
    ]);

    if($request->hasFile('image')){
        $formAddSubcategory['image']=$request->file('image')->store('images','public');
    }

    DB::table('subcategories')->where('id', $subcategory->id)->update($formAddSubcategory);
    return back()->with('success','Subategory updated successfully');


  }

//   controller to delete category
  public function deleteSubcategory(subcategory $subcategory)
{
    $subcategory->delete();
    return redirect($this->admin)->with('danger', 'Subcategory Deleted Successfully');
}






}

