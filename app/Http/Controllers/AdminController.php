<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Admin;

use App\Models\Customer;

use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Middleware\store as MiddlewareStore;
use App\Models\product;
use App\Models\Store; // Adjust the namespace as per your project structure

// use Auth;






class AdminController extends Controller
{
    // declaring the variable for this moment
    protected $admin;

    public function __construct()
    {
        // Define the $admin variable here
        $this->admin = 'admin';
    }


    public function SearchAdmin(){
        $search_text = $_GET['search'];
        $products=product::where('name','LIKE','%'.$search_text.'%')->get();
        return view($this->admin . '.dashboard.searchadmin');

    }

    public function AdminLogin()
    {
        return view($this->admin . '.login');
    }


    //contoller to the display dashboard

    public function indexDashboard()
    {
        // Use the $admin variable inside the method
        return view($this->admin . '.dashboard.index');
    }





    public function showManageProfileAdmin()
    {
        // Use the $admin variable inside the method
        return view($this->admin . '.dashboard.manageprofileadmin');
    }

    // controller to edit profile for the admin
    public function updateAdmin(Request $request)

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
        $adminId = auth()->guard('admin')->id();
        //  dd($adminId);

        // Update the superadmin's profile based on the input data
        $admin = DB::table('admins')->where('id', $adminId)->first();

        if ($admin) {
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
            DB::table('admins')->where('id', $adminId)->update($data);

            // Redirect back to the profile page or any other desired page
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            // Handle the case where the superadmin record is not found
            return redirect()->back()->with('danger', 'Admin not found');
        }
    }



    //show manage user

    public function showManageUser()
    {
        return view($this->admin . '.dashboard.manageuser',[
            'customers'=>Customer::latest('id')->paginate(10)
        ]);
    }










    public function showAdminLogin()
    {
        return view($this->admin . '.login');
    }




    //  public function authenticateAdmin(Request $request)
    //  {
    //      $formFields = $request->validate([
    //          'email' => 'required',
    //          'password' => 'required'
    //      ]);

    //     //  dd($formFields);
    //      if (auth()->guard('admin')->attempt($formFields)) {
    //          $request->session()->regenerate();
    //          return   redirect($this->admin )->with('success', ' logged in successfully !');
    //      }

    //      return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
    //  }

    public function allowLoginAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo"<pre>"; print_r($data); die;
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect($this->admin)->with('success', 'Logged in successfully ');
            } else {
                // return redirect()->back()->with('danger ', 'Invalid Email or Password');
                return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');

            }
        }
    }


    // route to  logout supper admin
    public function logoutAdmin(Request $request)
    {
        // remove the authentification information for the user Session
        Auth()->logout();
        //to invalidate the user authontification and regenarate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route($this->admin . '.login')->with('success', 'logged out successfully !');
    }




    //  public function authenticateAdmin(Request $request)
    //  {
    //      $credentials = $request->only('email', 'password');

    //      if (Auth::guard('admin')->attempt($credentials, true)) {
    //          // Authentication was successful with "Remember Me" enabled
    //          return redirect()->intended('/admin'); // Redirect to the intended page after login
    //      }

    //      // Authentication failed
    //      return back()->withErrors(['email' => 'Invalid credentials']);
    //  }





    public function storemanagerRegisterpage()
    {
        return view($this->admin . '.admin_users.register');
    }


    public function supplierRegisterpage()
    {
        return view($this->admin . '.admin_users.registersupplier');
    }

    // contoller to shows manage store page
    // public function showStoremanager()
    // {
    //     return view($this->admin . '.dashboard.storemanager', [
    //         'stores' => Store::query()->latest('id')->paginate(6)
    //     ]);
    // }

    public function showStoremanager()
    {
        return view($this->admin . '.dashboard.storemanager',[
            'stores'=>Store::latest('id')->paginate(10)
        ]);
    }

    // controller to delete store manage by the admin
    public function deleteStore(Store $store)
{
    $store->delete();
    return redirect($this->admin)->with('danger', 'Store Manager Deleted Successfully');
}









    // contoller to store manager
    // public function storeStoreManager(Request $request)
    // {
    //     // Retrieve the currently logged-in super admin
    //     $admin = Auth::user(); // Assuming your super admin is authenticated.

    //     $formFieldstore = $request->validate([
    //         'name' => ['required', 'min:3'],
    //         'email' => ['required', Rule::unique('stores', 'email')],
    //         'street' => 'required',
    //         'number' => ['required', Rule::unique('stores', 'number')],
    //         'NIN' => ['required', Rule::unique('stores', 'NIN')],
    //         'password' => ['required', 'confirmed', 'min:6'],
    //         'division' => 'required',
    //         'city' => 'required',
    //         'country' => 'required',
    //     ]);

    //     // Include the superadmin_id in the form fields
    //     $formFieldstore['admin_id'] = $admin->id;

    //     // Hash the password
    //     if ($request->hasFile('image')) {
    //         $formFieldstore['image'] = $request->file('image')->store('images', 'public');
    //     }
    //     $formFieldstore['password'] = bcrypt($formFieldstore['password']);

    //     // Insert the admin record into the database
    //     DB::table('stores')->insert($formFieldstore);

    //     return redirect($this->admin)->with('success', 'Account created successfully');
    // }



    public function storeStoreManager(Request $request)
    {
        // Check if the user is authenticated as an admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route($this->admin . '.login')->with('error', 'You are not authorized.');
        }

        $admin = Auth::guard('admin')->user();

        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', Rule::unique('stores', 'email')],
            'street' => 'required',
            'number' => ['required', Rule::unique('stores', 'number')],
            'NIN' => ['required', Rule::unique('stores', 'NIN')],
            'password' => ['required', 'confirmed', 'min:6'],
            'division' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        // Hash the password
        $formFields['password'] = bcrypt($formFields['password']);

        // Include the admin_id in the form fields
        $formFields['admin_id'] = $admin->id;

        // Store the image if provided
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        // Insert the store manager record into the database
        DB::table('stores')->insert($formFields);

        return redirect($this->admin)->with('success', 'Store manager account created successfully.');

    }

    // controller to change password for the admin


    // public function changePasswordAdmin(Request $request)
    // {

    //     // Validate the form data
    //     $validator = Validator::make($request->all(), [
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:6|confirmed',
    //     ]);

    //     // If validation fails, redirect back with errors
    //     if ($validator->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }


    //     // Check if the old password matches the authenticated user's password
    //     // $user = Auth::user();
    //     $user =$request->user();


    //     if (!Hash::check($request->input('old_password'), $user->password)) {
    //         return redirect()
    //             ->back()
    //             ->with('error', 'The Old password is incorrect.');
    //     }

    //     // Update the user's password with the new one
    //     // $user->password = Hash::make($request->input('new_password'));
    //     // $user->save();
    //     $user->update([
    //         'password' => Hash::make($request->input('new_password')),
    //     ]);

    //     return redirect()->route('dashboard.manageprofileadmin')->with('success', 'Password changed successfully.');
    // }


    // controller to change pwd
    public function changePasswordAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                // return redirect()->back()->with('success','Your current Password is changed successfully');
                // check if the new and confirm password is the same
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    // update the new pwd
                    // Admin::where(['id'=>Auth::guard('admin')->user()->id])->update(['password'=>$data['<PASSWORD>_<PASSWORD>']
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success', 'Your current Password is changed successfully');
                } else {
                    return redirect()->back()->with('danger', 'Your  New  Password  Mismatch Retype the Password');
                }
            } else {
                return redirect()->back()->with('danger', 'Your current Password does not match');
                // echo "<script>alert('Your current Password does not match')</script>";
            }
        }
        return view($this->admin . '.dashboard.manageprofileadmin');
    }
    // controller to check wether the password is correct
    public function CheckPasswordCurrent(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }




    //





}
