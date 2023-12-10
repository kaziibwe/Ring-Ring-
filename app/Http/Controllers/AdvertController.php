<?php

namespace App\Http\Controllers;

use App\Models\advert;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdvertController extends Controller
{
    //
    // declaring the variable for this moment
    protected $admin;

    public function __construct()
    {
        // Define the $admin variable here
        $this->admin = 'admin';
    }


 //show home adverts

    public function showManageHomeAdvert()
    {
        return view($this->admin . '.dashboard.managehomeadvert',[
            'adverts'=>advert::latest('id')->paginate(6)
        ]);
    }

       //show add maincategory

       public function showAddHomeAdvert()
       {
           return view($this->admin.'.dashboard.addhomeadvert');
       }



       // Controller to store the home adverts
       public function storeHomeAdvert(Request $request){
        $formAddHomeAdvert = $request->validate([
            'name'=> ['required', Rule::unique('adverts','name')],
             'description'=>'required',
        ]);

        if($request->hasFile('image')){
            $formAddHomeAdvert['image']=$request->file('image')->store('images','public');
        }

        DB::table('adverts')->insert($formAddHomeAdvert);
        return redirect($this->admin)->with('success','Home Advert Created Successfully');

      }

       // contoller to show edit advert page
     public function showEditSidvert(advert $advert){
        return view($this->admin.'.dashboard.editadvert',['advert'=>$advert]);
    }

       // Controller to update the home adverts
       public function updateAdvert(Request $request, advert $advert){
        $formAddHomeAdvert = $request->validate([
            'name'=> 'required',
             'description'=>'required',
        ]);

        if($request->hasFile('image')){
            $formAddHomeAdvert['image']=$request->file('image')->store('images','public');
        }


        DB::table('adverts')->where('id', $advert->id)->update($formAddHomeAdvert);
            return back()->with('success',' Advert updated successfully');

    }

    public function deleteAdvert(advert $advert)
    {
        $advert->delete();
        return redirect($this->admin)->with('danger', ' Advert Deleted Successfully');
    }
}
