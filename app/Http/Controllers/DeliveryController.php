<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\order;
use App\Models\Delivaryman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\deliveryman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Deliveryman as ModelsDeliveryman;


class DeliveryController extends Controller
{
    //
    // declaring the variable for this moment
    protected $admin;
    protected $deliveryman;


    public function __construct()
    {
        // Define the $admin variable here
        $this->admin = 'admin';
        $this->deliveryman = 'deliveryman';
    }


    //show manage  delivary

    public function showManageDelivery()
    {
        return view($this->admin . '.dashboard.managedelivery');
    }

    // route to see the dashboard of the deliveryman
    public function indexDeliveryman()
    {
        return view($this->deliveryman . '.dashboard.indexdeliveryman');
    }

    public function AlreadyOrder(order $order)
    {
        $orders = Order::where('Order_status', 'Processed')->paginate(20);

        return view($this->deliveryman . '.dashboard.alreadyorder', ['orders' => $orders]);
    }



    // public function showMyDelivery(order $order, deliveryman $delivarman)
    // {
    //     $orders = Order::where('Order_status', 'On Delivary')->paginate(20);
    //     $delivarman->load(['orders']);


    //     return view($this->deliveryman . '.dashboard.mydelivary',['orders'=>$orders]);
    // }


    public function showMyDelivery()
    {
        $deliverymanId = Auth::guard('deliveryman')->user('')->id;
        // dd($deliverymanId);
        // Assuming you have a logged-in deliveryman
        // Retrieve orders with 'On Delivery' status for the current deliveryman
        $orders = Order::whereHas('deliveries', function ($query) use ($deliverymanId) {
            $query->where('Order_status', 'On Delivery')
                ->where('deliveryman_id', $deliverymanId);
        })->get();

        return view($this->deliveryman . '.dashboard.mydelivary', compact('orders'));
    }



    public function logoutDeliveryman(Request $request)
    {
        // remove the authentification information for the user Session
        Auth()->logout();
        //to invalidate the user authontification and regenarate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route($this->deliveryman . '.login')->with('success', 'logged out successfully !');
    }


    // controller to the login page of the delivary man

    public function DeliverymanLogin()
    {
        return view($this->deliveryman . '.login');
    }


    public function authenticateDeliveryMan(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo"<pre>"; print_r($data); die;
            if (Auth::guard('deliveryman')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect($this->deliveryman)->with('success', 'Logged in successfully ');
            } else {
                // return redirect()->back()->with('danger ', 'Invalid Email or Password');
                // return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
                return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');


            }
        }
    }



    // controller to show profile admin
    public function showManageProfileDeliveryman()
    {
        // Use the $admin variable inside the method
        return view($this->deliveryman . '.dashboard.manageprofiledeliveryman');
    }


    // controller to change pwd
    public function changePasswordDeliveryman(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //
            if (Hash::check($data['current_pwd'], Auth::guard('deliveryman')->user()->password)) {
                // return redirect()->back()->with('success','Your current Password is changed successfully');
                // check if the new and confirm password is the same
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    // update the new pwd
                    // Admin::where(['id'=>Auth::guard('admin')->user()->id])->update(['password'=>$data['<PASSWORD>_<PASSWORD>']
                    ModelsDeliveryman::where('id', Auth::guard('deliveryman')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success', 'Your current Password is changed successfully');
                } else {
                    return redirect()->back()->with('danger', 'Your  New  Password  Mismatch Retype the Password');
                }
            } else {
                return redirect()->back()->with('danger', 'Your current Password does not match');
                // echo "<script>alert('Your current Password does not match')</script>";
            }
        }
        return view($this->deliveryman . '.dashboard.manageprofiledeliveryman');
    }


    public function updateDeliveryman(Request $request)

    {
        // dd($request->input('image'));
        // Validate the input data, including the image field
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'street' => 'required',
            'number' => 'required',
            'division' => 'required',
            'city' => 'required',
            'country' => 'required',
            'company' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            // Add other validation rules as needed
        ]);

        // Get the authenticated superadmin's ID
        $DeliveryId = auth()->guard('deliveryman')->id();
        //  dd($DeliveryId);

        // Update the superadmin's profile based on the input data
        $deliveryman = DB::table('deliverymen')->where('id', $DeliveryId)->first();

        if ($deliveryman) {
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
            DB::table('deliverymen')->where('id', $DeliveryId)->update($data);

            // Redirect back to the profile page or any other desired page
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            // Handle the case where the superadmin record is not found
            return redirect()->back()->with('danger', 'Deliveryman not found');
        }
    }


    // public function CheckVerificationCode(Request $request)
    // {
    //     // Use the input method to retrieve the 'Order_number' from the request
    //     $orderNumber = $request->input('Order_number');

    //     // Check if the order number exists in the 'orders' table
    //     $orderExists = DB::table('orders')
    //         ->where('Order_number', $orderNumber)
    //         ->exists();

    //     if ($orderExists) {
    //         return "true"; // Order number exists
    //     } else {
    //         return "false"; // Order number does not exist
    //     }
    // }

    public function CheckVerificationCode(Request $request)
    {
        // Use the input method to retrieve the 'Order_number' and 'tracking_no' from the request
        $orderNumber = $request->input('Order_number');
        $trackingNumber = $request->input('tracking_no');

        // dd($trackingNumber);
        // Check if an order with the specified 'Order_number' and 'tracking_no' exists
        $orderExists = DB::table('orders')
            ->where('Order_number', $orderNumber)
            ->where('tracking_no', $trackingNumber)
            ->exists();

        if ($orderExists) {
            return "true"; // Both Order number and Tracking number match
        } else {
            return "false"; // Either Order number or Tracking number does not match
        }
    }


    // confirm delivery


public function ConfirmDelivery(Request $request)
{
    // Use the input method to retrieve the 'Order_number' and 'tracking_no' from the request
    $orderNumber = $request->input('Order_number');
    $trackingNumber = $request->input('tracking_no');
    $name = $request->input('name');
    $calculated_total = $request->input('calculated_total');
    $payment_mode = $request->input('payment_mode');




    // Check if an order with the specified 'Order_number' and 'tracking_no' exists
    $orderExists = DB::table('orders')
        ->where('Order_number', $orderNumber)
        ->where('tracking_no', $trackingNumber)
        ->exists();

    if ($orderExists) {
        // Get the order ID based on the Order_number and tracking_no
        $orderId = DB::table('orders')
            ->where('Order_number', $orderNumber)
            ->where('tracking_no', $trackingNumber)
            ->value('id');

        if ($orderId) {
            // Update the order status to 'Delivered'
            DB::table('orders')
                ->where('id', $orderId)
                ->update(['Order_status' => 'Delivered']);

            // Update the related 'deliveries' table with the current timestamp
            DB::table('deliveries')
                ->where('order_id', $orderId)
                ->update([
                    'deliveredorderdate' => Carbon::now(),
                    'tracking_no' => $trackingNumber,
                    'name' => $name,
                    'calculated_total' => $calculated_total,
                    'payment_mode' => $payment_mode

                ]

            );
        }

        return redirect()->back()->with('success', 'Order Confirmed delivered');
    } else {
        return redirect()->back()->with('danger', 'Your confirmation code is wrong');
    }
}


    // public function ConfirmDelivery(Request $request)
    // {
    //     // Use the input method to retrieve the 'Order_number' and 'tracking_no' from the request
    //     $orderNumber = $request->input('Order_number');
    //     $trackingNumber = $request->input('tracking_no');

    //     // Check if an order with the specified 'Order_number' and 'tracking_no' exists
    //     $orderExists = DB::table('orders')
    //         ->where('Order_number', $orderNumber)
    //         ->where('tracking_no', $trackingNumber)
    //         ->exists();

    //     if ($orderExists) {
    //         // Update the order status to 'delivered'
    //         // Update the order status to 'delivered'
    //         DB::table('orders')
    //             ->where('Order_number', $orderNumber)
    //             ->where('tracking_no', $trackingNumber)
    //             ->update(['Order_status' => 'Delivered']);



    //         return redirect()->back()->with('success', 'Order Confirmed delivered');
    //     } else {
    //         return redirect()->back()->with('danger', 'Your confirmation code is wrong');
    //     }
    // }

    // controller to change pwd
    //   public function ConfirmDelivery(Request $request)
    //   {
    //       if ($request->isMethod('post')) {
    //           $data = $request->all();
    //           //
    //           if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
    //               // return redirect()->back()->with('success','Your current Password is changed successfully');
    //               // check if the new and confirm password is the same
    //             //   if ($data['new_pwd'] == $data['confirm_pwd']) {
    //             //       // update the new pwd
    //             //       // Admin::where(['id'=>Auth::guard('admin')->user()->id])->update(['password'=>$data['<PASSWORD>_<PASSWORD>']
    //             //       Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
    //             //       return redirect()->back()->with('success', 'Your current Password is changed successfully');
    //             //   } else {
    //             //       return redirect()->back()->with('danger', 'Your  New  Password  Mismatch Retype the Password');
    //             //   }
    //           } else {
    //               return redirect()->back()->with('danger', 'Your current Password does not match');
    //               // echo "<script>alert('Your current Password does not match')</script>";
    //           }
    //       }
    //       return redirect()->back();
    //   }



    // public function DeliveryHistory()
    // {
    //     return view($this->deliveryman . '.dashboard.managehistory');
    // }


public function DeliveryHistory()
{
    // Get the authenticated user (assuming you are using Laravel's built-in authentication)
    $user = Auth::guard('deliveryman')->user();
    if ($user) {
        // Use the authenticated user's ID to retrieve their delivery history
        $deliveryManId = $user->id;
        // Retrieve the delivery history for the specific delivery man
        $deliveryHistory = DB::table('deliveries')
            ->where('deliveryman_id', $deliveryManId)
            ->orderBy('deliveredorderdate', 'desc') // Order by the creation date in descending order
            ->paginate(20);
        // Pass the delivery history data to the view
        return view($this->deliveryman . '.dashboard.managehistory', ['deliveryHistory' => $deliveryHistory]);
    } else {
        // Redirect unauthorized users to a different page or show an error message
        return redirect($this->deliveryman . '/login')->with('danger', 'Unauthorized access.');
    }
}








}
