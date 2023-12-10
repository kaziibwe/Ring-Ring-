<?php

namespace App\Http\Controllers;

use App\Models\advert;
use App\Models\category;
use App\Models\product;
use App\Models\sideadvert;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class   CategoryController extends Controller
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

//    public function viewCategory(category $category){
//     return view('front_end.front.categorypage',['category'=>$category]);
//}



   public function showManageCategory()
      {
          return view($this->admin . '.dashboard.managecategory',[
            'categories'=>category::latest('id')->paginate(6)
        ]);
      }

//     //   public function viewCategor()
//     //   {
//     //       $categories = Category::with('subcategories')->get();

//     //       return view('front_end.front.categorypage', [
//     //           'categories' => $categories
//     //       ]);
//     //   }





//

    //show add maincategory

    public function showAddCategory()
    {
        return view($this->admin.'.dashboard.addcategory');
    }

    public function storeCategory(Request $request){
        $formAddCategory = $request->validate([
            'name'=> ['required', Rule::unique('categories','name')],
             'Active'=>'required',
             'Featured'=>'required'
        ]);

        DB::table('categories')->insert($formAddCategory);
        return redirect($this->admin)->with('success','Category Created Successfully');

      }


    //   on the use of the protected in the modal
//        protected $table = 'categories'

// public function storeCategory(Request $request)
// {
//     $formAddCategory = $request->validate([
//         'name' => ['required', Rule::unique('categories', 'name')],
//         'Active' => 'required',
//         'Featured' => 'required'
//     ]);

//     // Create a new Category instance and fill it with form data
//     $category = new Category();
//     $category->name = $formAddCategory['name'];
//     $category->Active = $formAddCategory['Active'];
//     $category->Featured = $formAddCategory['Featured'];
//     $category->save();

//     return redirect($this->admin)->with('success', 'Category Created Successfully');
// }

//


    // contoller to show edit category page
    public function showEditCategory(category $category){
        return view($this->admin.'.dashboard.editcategory',['category'=>$category]);
    }






// a controller to update category

public function updateCategory(Request $request, category $category){
    $formAddCategory = $request->validate([
        'name'=> 'required',
         'Active'=>'required',
         'Featured'=>'required'
    ]);

    DB::table('categories')->where('id', $category->id)->update($formAddCategory);
//    session::flush('message','listing created successfully');
    return back()->with('success','Category updated successfully');


  }


//controller to delete categry delete


public function deleteCategory(Category $category)
{
    $category->delete();
    return redirect($this->admin)->with('danger', 'Category Deleted Successfully');
}





}








