<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Middleware\superadmin as MiddlewareSuperadmin;


class SuperAdminController extends Controller
{
    //
    protected $s_admin;

    public function __construct()
    {
        // Define the $s_admin variable here
        $this->s_admin = 's_admin';
    }

    public function showSuperAdminLogin()
    {
        return view($this->s_admin . '.login');
    }


    // diplay dashboard of supper s_admin

    public function showSuperAdmin()
    {
        return view($this->s_admin . '.dash.index');
    }
    //show manage admin


    public function showMangeAdmin()
    {
        return view($this->s_admin . '.dash.manageadmin',[
            'admins'=>Admin::latest('id')->paginate(6)
        ]);
    }

    //show edit admin

    public function showAddAdmin()
    {
        return view($this->s_admin . '.dash.addadmin');
    }



public function storeAdmin(Request $request)
{
      // Check if the user is authenticated as an superadmin
      if (!Auth::guard('superadmin')->check()) {
        return redirect()->route($this->s_admin.'.login')->with('error', 'You are not authorized.');
    }

    $superadmin = Auth::guard('superadmin')->user();
    // Retrieve the currently logged-in super admin
    // $superadmin = Auth::user(); // Assuming your super admin is authenticated.

    $formFieldsadmins = $request->validate([
        'name' => ['required', 'min:3'],
        'email' => ['required', Rule::unique('admins', 'email')],
        'street' => 'required',
        'number' => ['required', Rule::unique('admins', 'number')],
        'NIN' => ['required', Rule::unique('admins', 'NIN')],
        'password' => ['required', 'confirmed', 'min:6'],
        'division' => 'required',
        'city' => 'required',
        'country' => 'required',
    ]);

    // Include the superadmin_id in the form fields
    $formFieldsadmins['superadmin_id'] = $superadmin->id;


    // Hash the password
    if ($request->hasFile('image')) {
        $formFieldsadmins['image'] = $request->file('image')->store('images', 'public');
    }
    $formFieldsadmins['password'] = bcrypt($formFieldsadmins['password']);

    // Insert the admin record into the database
    DB::table('admins')->insert($formFieldsadmins);

    return redirect($this->s_admin)->with('success', 'Account created successfully');
}

// controller to update supper admin
// function updateSupperAdmin (Request $req){
    // $supperadmin=SuperAdmin::findorfail($req->id);
    // $supperadmin -> name=$req->input('name') ;
    // $supperadmin -> email=$req->input('email') ;
    // $supperadmin -> street =$req-> input ('street')  ;
    // $supperadmin -> number =$req-> input ('number')   ;
    // $supperadmin -> NIN =$req-> input ('NIN')    ;
    // $supperadmin -> division =$req-> input ('division')     ;
    // $supperadmin -> city =$req-> input ('city')      ;
    // $supperadmin -> country =$req-> input ('country')       ;
    // if(isset($_FILES["image"]["type"])){
    //     $filename=$_FILES["image"]["tmp_name"];
    //     $imgData=base64_encode( file_get_contents($filename));
    //     $supperadmin -> image =$imgData;
    //     };
    //     if(!empty($req->input('password'))){$supperadmin -> password=<PASSWORD>1($req->input('password'));};
    //     if (!empty($req->input('phone'))){$supperadmin -> phone=$req->input('phone')}else{echo "no";}
    //     if(!$supperadmin->save()){return response()->json(['error'=>'something went wrong!']);} else{return response()->json(['message'=>
    //         if (!$supperadmin->save()) {
    //             return back()->withErrors(['error'=>'Error updating user!'])->withInput();
    //             }}



    // public function updateSuperAdmin(Request $request)
    // {

    //     $superadmin = auth()->guard('superadmin')->user();

    //     $userData = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'street' => 'required',
    //         'number' => 'required',
    //         'role' => 'required',
    //         'division' => 'required',
    //         'city' => 'required',
    //         'country' => 'required',
    //     ]);


    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('images', 'public');
    //         $userData['image'] = $imagePath;
    //     }
    //     // Use DB::table to update the superadmin's record
    //     DB::table('superadmins')
    //         ->where('id', $superadmin->id)
    //         ->update($userData);

    //     return redirect($this->s_admin)->with('success', 'Admin information successfully updated');
    // }

    public function updateSuperAdmin(Request $request)
    {
        // Validate the input data, including the image field
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'street' => 'required',
            'number' => 'required',
            'role' => 'required',
            'division' => 'required',
            'city' => 'required',
            'country' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            // Add other validation rules as needed
        ]);

        // Get the authenticated superadmin's ID
        $superadminId = auth()->guard('superadmin')->id();

        // Update the superadmin's profile based on the input data
        $superadmin = DB::table('superadmins')->where('id', $superadminId)->first();

        if ($superadmin) {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'number' => $request->input('number'),
                'street' => $request->input('street'),
                'division' => $request->input('division'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'role' => $request->input('role'),
            ];
            // dd($data);

            // Handle image upload if a file is provided
            if ($request->hasFile('image')) {
                $photoPath = $request->file('image')->store('images', 'public');
                $data['image'] = $photoPath;
            }

            // Update the superadmin's record
            DB::table('superadmins')->where('id', $superadminId)->update($data);

            // Redirect back to the profile page or any other desired page
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            // Handle the case where the superadmin record is not found
            return redirect()->back()->with('error', 'Superadmin not found');
        }
    }











// public function allowLoginAdmin(Request $request){
//     if($request->isMethod('post')){
//         $data=$request->all();
//         // echo"<pre>"; print_r($data); die;
//         if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
//             return redirect($this->s_admin)->with('success','Logged in successfully ');
//         }else
//         {
//             return redirect()->back()->with('danger ', 'Invalid Email or Password');
//         }
//         }
//     }




    //  controller to showMangeS_Admin

    public function showMangeS_Admin()
    {
        return view($this->s_admin . '.dash.manages_admin',[
            'superadmins'=>Superadmin::latest('id')->paginate(6)
        ]);
    }

    // route to add admin
    public function  showAddS_Admin()
    {
        return view($this->s_admin . '.dash.adds_admin');
    }



    //store storeS_Admin
    public function storesuperADmin(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', Rule::unique('superadmins', 'email')],
            'role' => 'required',
            'password' => ['required', 'confirmed', 'min:6',],
        ]);
        //hash password
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
        $formFields['password'] = bcrypt($formFields['password']);
        DB::table('superadmins')->insert($formFields);
        return redirect($this->s_admin)->with('success', 'Account  created successfully');
    }

    // public function     showS_AdminLogin(Request $request)
    // {
    //     $redirectUrl = $request->input('redirect');
    //     // You can pass $redirectUrl to the view if needed
    //     return view($this->s_admin . '.dash.s_admin_users.login', compact('redirectUrl'));
    // }

    public function showS_AdminLogin()
    {
        return view($this->s_admin . '.s_admin_users.login');
    }




    // public function authenticateS_Admin(Request $request)
    // {
    //     $formFields = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    //     if (auth()->attempt($formFields)) {
    //         $request->session()->regenerate();
    //         return   redirect($this->s_admin . '.dash.index')->with('success', ' logged in successfully !');
    //     }
    //     return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
    // }

    public function authenticateSuperAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo"<pre>"; print_r($data); die;
            if (Auth::guard('superadmin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect($this->s_admin)->with('success', 'Logged in successfully ');
            } else {
                // return redirect()->back()->with('danger ', 'Invalid Email or Password');
                return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');

            }
        }
    }

    // route to  logout supper admin
    public function logoutS_Admin(Request $request)
    {
        // remove the authentification information for the user Session
        Auth()->logout();
        //to invalidate the user authontification and regenarate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('s_admin.login')->with('success', 'logged out successfully !');
    }


      // contoller to show edit admin
      public function showEditADmin(admin $admin){
        return view($this->s_admin.'.dash.editadmin',['admin'=>$admin]);
    }

    // controller to delete admin
    public function deleteAdmin(Admin $Admin)
    {
        $Admin->delete();
        return redirect($this->s_admin)->with('danger', ' Admin Deleted Successfully');
    }



// controller to show profile admin
public function showManageProfileS_admin()
{
    // Use the $admin variable inside the method
    return view($this->s_admin . '.dash.manageprofiles_admin');
}


//  // controller to change pwd
 public function changePasswordSuperadmin(Request $request){
    if($request->isMethod('post')){
        $data = $request->all();
        //
        if(Hash::check($data['current_pwd'],Auth::guard('superadmin')->user()->password)){
            // return redirect()->back()->with('success','Your current Password is changed successfully');
            // check if the new and confirm password is the same
            if($data['new_pwd'] == $data['confirm_pwd']){
                // update the new pwd
                // Admin::where(['id'=>Auth::guard('admin')->user()->id])->update(['password'=>$data['<PASSWORD>_<PASSWORD>']
                Superadmin::where('id',Auth::guard('superadmin')->user()->id )->update(['password'=>bcrypt($data['new_pwd'])]);
                 return redirect()->back()->with('success','Your current Password is changed successfully');

            }else {
               return redirect()->back()->with('danger','Your  New  Password  Mismatch Retype the Password');

            }

        }else{
            return redirect()->back()->with('danger','Your current Password does not match');
            // echo "<script>alert('Your current Password does not match')</script>";
        }
    }
    return view($this->s_admin . '.dashboard.changepasswordsuperadmin');
}

}
