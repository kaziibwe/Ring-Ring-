<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //

    public function showRegister()
    {
        return view('front_end.users.register');
    }

    // controller to the customer
    public function showUserProfile()
    {
        return view('front_end.front.customerprofile');
    }


    //store
    public function storeUser(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', Rule::unique('customers', 'email')],
            'number' => ['required', Rule::unique('customers', 'number')],
            'street' => 'required',
            'division' => 'required',
            'city' => 'required',
            'password' => ['required', 'confirmed', 'min:6',]
        ]);
        //hash password
        $formFields['password'] = bcrypt($formFields['password']);
        //First, the user data is inserted into the "customers" table using DB::table('customers')->insert($formFields).
        DB::table('customers')->insert($formFields);
        //Then, the user is fetched from the database using the email provided ($formFields['email']) using DB::table('customers')->where('email', $formFields['email'])->first()
        $customer = DB::table('customers')->where('email', $formFields['email'])->first();

        auth()->loginUsingId($customer->id);

        //  Finally, a redirection is performed to
        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return Redirect()->to($oldUrl);
        }

        return redirect('/')->with('front_success', 'Acount  created successfully and logged in');
    }

    // controller to login page of the customer
    public function showLogin(Request $request)
    {
        $redirectUrl = $request->input('redirect');

        // You can pass $redirectUrl to the view if needed
        return view('front_end.users.login', compact('redirectUrl'));
    }



    // // controller to authenticate user
    // public function authenticateUser(Request $request)
    // {
    //     $formFields = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    //     if (auth()->attempt($formFields)) {
    //         $request ->session()->regenerate();
    //         if (Session::has('oldUrl')) {
    //             $oldUrl = Session::get('oldUrl');
    //             Session::forget('oldUrl');
    //             return Redirect()->to($oldUrl);
    //         }
    //         return   redirect('/')->with('front_success', ' logged in successfully !');
    //     }
    //     return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
    // }


    public function authenticateUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo"<pre>"; print_r($data); die;
            if (Auth::guard('customer')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                if (Session::has('oldUrl')) {
                    $oldUrl = Session::get('oldUrl');
                    Session::forget('oldUrl');
                    return Redirect()->to($oldUrl);
                }
                return redirect('/')->with('success', 'Logged in successfully ');
            } else {
                // return redirect()->back()->with('danger ', 'Invalid Email or Password');
                        return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');

            }
        }
    }

    // controller to logout
    public function logoutUser(Request $request)
    {
        // remove the authentification information for the user Session
        Auth()->logout();
        //to invalidate the user authontification and regenarate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('front_success', 'logged out successfully !');
    }
}
