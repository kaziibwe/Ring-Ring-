<?php

namespace App\Http\Controllers;

use App\Models\Deliveryman;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;



class DeliverymanController extends Controller
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

     public function showManageDeliveryMan()
     {
         return view($this->admin . '.dashboard.managedeliveryman',[
            'deliverymen'=>Deliveryman::latest('id')->paginate(6)
        ]);
     }
// controller to delete the delivery man
     public function deleteDeliveryman(Deliveryman $deliveryman)
     {
         $deliveryman->delete();
         return redirect($this->admin)->with('danger', 'Deliveryman Deleted Successfully');
     }

   //show edit maincategory

   public function showAddDelivaryMan()
   {
       return view($this->admin.'.dashboard.adddelivaryman');
   }

   //store delivary man
   public function storeDeliveryMan(Request $request){

    // Check if the user is authenticated as an admin
    if (!Auth::guard('admin')->check()) {
        return redirect()->route($this->admin . '.login')->with('error', 'You are not authorized.');
    }

    $admin = Auth::guard('admin')->user();

    $formFields =$request->validate([
        'name'=> ['required','min:3'],
        'email'=>['required', Rule::unique('deliverymen','email')],
        'number'=>['required',Rule::unique('deliverymen','number')],
        'NIN'=>['required',Rule::unique('deliverymen','NIN')],
        'street'=>'required',
        'division'=>'required',
        'city'=>'required',
        'country'=>'required',
        'password' => [ 'required','confirmed', 'min:6',]


        ]);

        $formFields['admin_id'] = $admin->id;

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('ninfront')) {
            $formFields['ninfront'] = $request->file('ninfront')->store('images', 'public');
        }

        if ($request->hasFile('ninback')) {
            $formFields['ninback'] = $request->file('ninback')->store('images', 'public');
        }

    DB::table('deliverymen')->insert($formFields);
    return redirect($this->admin)->with('success','Account  created successfully');


}





}
