<?php

namespace App\Http\Controllers;

use App\Models\side_advert;
use App\Models\sideadvert;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class SideAdvertController extends Controller
{
    //

        // declaring the variable for this moment
        protected $admin;

        public function __construct()
        {
            // Define the $admin variable here
            $this->admin = 'admin';
        }


     //show side adverts

        public function showManageSideAdvert()
        {
            return view($this->admin . '.dashboard.managesideadvert',[
                'sideadverts'=>sideadvert::latest('id')->paginate(6)
            ]);
        }

           //show add maincategory

    public function showAddSideAdvert()
    {
        return view($this->admin.'.dashboard.addsideadvert');
    }

     // Controller to store the side adverts
     public function storeSideAdvert(Request $request){
        $formAddHomeAdvert = $request->validate([
            'name'=> ['required', Rule::unique('sideadverts','name')],
             'description'=>'required',
        ]);

        if($request->hasFile('image')){
            $formAddHomeAdvert['image']=$request->file('image')->store('images','public');
        }

        DB::table('sideadverts')->insert($formAddHomeAdvert);
        return redirect($this->admin)->with('success','Side Advert Created Successfully');
    }



     // contoller to show edit sideadvert page
     public function showEditSideadvert(sideadvert $sideadvert){
        return view($this->admin.'.dashboard.editsideadvert',['sideadvert'=>$sideadvert]);
    }


        // Controller to update the side adverts
        public function updateSideadvert(Request $request, sideadvert $sideadvert){
            $formAddHomeAdvert = $request->validate([
                'name'=> 'required',
                 'description'=>'required',
            ]);

            if($request->hasFile('image')){
                $formAddHomeAdvert['image']=$request->file('image')->store('images','public');
            }


            DB::table('sideadverts')->where('id', $sideadvert->id)->update($formAddHomeAdvert);
                return back()->with('success','Side Advert updated successfully');

        }

        public function deleteSideAdvert(sideadvert $sideadvert)
{
    $sideadvert->delete();
    return redirect($this->admin)->with('danger', 'Side Advert Deleted Successfully');
}
}
