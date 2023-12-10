<?php

// namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Session;

// use App\Models\user;
// use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
// // use Illuminate\Contracts\Session\Session;

// class UserController extends Controller
// {
//     public function showRegister()
//     {
//         return view('front_end.users.register');
//     }


//     //store
//     public function storeUser(Request $request)
//     {
//         $formFields = $request->validate([
//             'name' => ['required', 'min:3'],
//             'email' => ['required', Rule::unique('users', 'email')],
//             'number' => ['required', Rule::unique('users', 'number')],
//             'street' => 'required',
//             'division' => 'required',
//             'city' => 'required',
//             'password' => ['required', 'confirmed', 'min:6',]


//         ]);
//         //hash password
//         $formFields['password'] = bcrypt($formFields['password']);
//         //First, the user data is inserted into the "users" table using DB::table('users')->insert($formFields).
//         DB::table('users')->insert($formFields);

//         //Then, the user is fetched from the database using the email provided ($formFields['email']) using DB::table('users')->where('email', $formFields['email'])->first()

//         $user = DB::table('users')->where('email', $formFields['email'])->first();


//         auth()->loginUsingId($user->id);

//         // Finally, a redirection is performed to
//         if (Session::has('oldUrl')) {
//             $oldUrl = Session::get('oldUrl');
//             Session::forget('oldUrl');
//             return Redirect()->to($oldUrl);
//         }

//         return redirect('/')->with('front_success', 'Acount  created successfully and logged in');
//     }

//     // public function showLogin(){
//     //     return view('front_end.users.login');
//     // }
//     public function showLogin(Request $request)
//     {
//         $redirectUrl = $request->input('redirect');

//         // You can pass $redirectUrl to the view if needed
//         return view('front_end.users.login', compact('redirectUrl'));
//     }





//     // controller to logout
//     public function logoutUser(Request $request)
//     {
//         // remove the authentification information for the user Session
//         Auth()->logout();
//         //to invalidate the user authontification and regenarate the token
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect('/')->with('front_success', 'logged out successfully !');
//     }

//     // controller to authenticate user
//     public function authenticateUser(Request $request)
//     {
//         $formFields = $request->validate([
//             'email' => 'required',
//             'password' => 'required'
//         ]);
//         if (auth()->attempt($formFields)) {
//             // $request ->session()->regenerate();
//             if (Session::has('oldUrl')) {
//                 $oldUrl = Session::get('oldUrl');
//                 Session::forget('oldUrl');
//                 return Redirect()->to($oldUrl);
//             }

//             return   redirect('/')->with('front_success', ' logged in successfully !');
//         }
//         return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
//     }
// }
