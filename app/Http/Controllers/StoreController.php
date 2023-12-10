<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
        // declaring the variable for this moment
        protected $store;

        public function __construct()
        {
            // Define the $store variable here
            $this->store = 'store';
        }


    public function storemanagerLogin()
    {
        return view($this->store . '.login');
    }


public function authenticatestoremanager(Request $request){
    if($request->isMethod('post')){
        $data=$request->all();
        // echo"<pre>"; print_r($data); die;
        if(Auth::guard('store')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect($this->store)->with('success','Logged in successfully ');
        }else
        {
            // return redirect()->back()->with('danger ', 'Invalid Email or Password');
            return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');

        }
        }
}


public function logoutStore(Request $request)
{
    // remove the authentification information for the user Session
    Auth()->logout();
    //to invalidate the user authontification and regenarate the token
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('storemanager.login')->with('success', 'logged out successfully !');
}

// controller to show profile admin
public function showManageProfileStore()
{
    // Use the $admin variable inside the method
    return view($this->store . '.dashboard.manageprofilestore');
}


 // controller to change pwd
 public function changePasswordStore(Request $request){
    if($request->isMethod('post')){
        $data = $request->all();
        //
        if(Hash::check($data['current_pwd'],Auth::guard('store')->user()->password)){
            // return redirect()->back()->with('success','Your current Password is changed successfully');
            // check if the new and confirm password is the same
            if($data['new_pwd'] == $data['confirm_pwd']){
                // update the new pwd
                // Admin::where(['id'=>Auth::guard('admin')->user()->id])->update(['password'=>$data['<PASSWORD>_<PASSWORD>']
                Store::where('id',Auth::guard('store')->user()->id )->update(['password'=>bcrypt($data['new_pwd'])]);
                 return redirect()->back()->with('success','Your current Password is changed successfully');

            }else {
               return redirect()->back()->with('danger','Your  New  Password  Mismatch Retype the Password');

            }

        }else{
            return redirect()->back()->with('danger','Your current Password does not match');
            // echo "<script>alert('Your current Password does not match')</script>";
        }
    }
    return view($this->store . '.dashboard.manageprofilestore');
}

// controller to change the password of the store
public function updateStore(Request $request)

{

  // Validate the input data, including the image field
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'street' => 'required',
        'number' => 'required',
        'division' => 'required',
        'city' => 'required',
        'country' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        // Add other validation rules as needed
    ]);

    // Get the authenticated superadmin's ID
    $storeId = auth()->guard('store')->id();
    //  dd($storeId);

    // Update the superadmin's profile based on the input data
    $store = DB::table('stores')->where('id', $storeId)->first();

    if ($store) {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'street' => $request->input('street'),
            'division' => $request->input('division'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'description' => $request->input('description'),
            'company' => $request->input('company'),
        ];

        // Handle image upload if a file is provided
        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('images', 'public');
            $data['image'] = $photoPath;
        }
        // Update the superadmin's record
        DB::table('stores')->where('id', $storeId)->update($data);

        // Redirect back to the profile page or any other desired page
        return redirect()->back()->with('success', 'Profile updated successfully');
    } else {
        // Handle the case where the superadmin record is not found
        return redirect()->back()->with('danger', 'store not found');
    }
}







}
