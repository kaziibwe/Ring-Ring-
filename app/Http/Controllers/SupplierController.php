<?php

namespace App\Http\Controllers;
use App\Models\order;
use App\Models\orderitem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use App\Http\Middleware\supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier as ModelsSupplier;

class SupplierController extends Controller
{
    //
    protected $supplier;
    protected $admin;


    public function __construct()
    {
        // Define the $supplier variable here
        $this->supplier = 'supplier';
        $this->admin = 'admin';

    }

    public function showSupplierLogin()
    {
        return view($this->supplier . '.login');
    }


    // diplay dashboard of supper supplier

    public function showSupplierDashboard()
    {
        return view($this->supplier . '.dashboard.index');
    }
    //show manage admin


     //store delivary man
   public function storeSupplier(Request $request){

    // Check if the user is authenticated as an admin
    if (!Auth::guard('admin')->check()) {
        return redirect()->route($this->admin . '.login')->with('error', 'You are not authorized.');
    }

    $admin = Auth::guard('admin')->user();

    $formFields =$request->validate([
        'name'=> ['required','min:3'],
        'email'=>['required', Rule::unique('suppliers','email')],
        'number'=>['required',Rule::unique('suppliers','number')],
        'street'=>'required',
        'division'=>'required',
        'city'=>'required',
        'country'=>'required',
        'product'=>'required',
        'password' => [ 'required','confirmed', 'min:6',]
        ]);
        $formFields['admin_id'] = $admin->id;
        //hash password
        $formFields['password'] = bcrypt($formFields['password']);
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
    DB::table('suppliers')->insert($formFields);
    return redirect($this->admin)->with('success','Account  created successfully');
}


// controller to show manage controllers

public function showManagesupplier()
{
    return view($this->admin . '.dashboard.managesupplier',[
        'suppliers'=>Supplier::latest('id')->paginate(10)
    ]);
}


// controller to authenticate  the supplier
public function authenticateSupplier(Request $request){
    if($request->isMethod('post')){
        $data=$request->all();
        // echo"<pre>"; print_r($data); die;
        if(Auth::guard('supplier')->attempt(['email'=>$data['email'],'password'=>$data['password']])){

            // dd($data);
            return redirect($this->supplier)->with('success','Logged in successfully ');
        }else
        {
            // return redirect()->back()->with('danger ', 'Invalid Email or Password');
            return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');

        }
        }
}


// controller to logout the supplier

public function logoutSupplier(Request $request)
{
    // remove the authentification information for the user Session
    Auth()->logout();
    //to invalidate the user authontification and regenarate the token
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('supplier.login')->with('success', 'logged out successfully !');
}









// public function showOrderSupplier()
// {
//     // Retrieve all orders with an 'ordered' status
//     $orders = Order::where('Order_status', 'ordered')->get();

//     // Initialize an empty array to store grouped order items
//     $groupedOrderItems = [];

//     foreach ($orders as $order) {
//         // Get all order items for the current order
//         $orderItems = $order->orderItems;

//         foreach ($orderItems as $item) {
//             // Get the product for the current order item
//             $product = $item->product;
//             // Get the supplier for the product
//             $supplier = $product->supplier;

//             // Check if the supplier's ID matches the desired ID (in this case, $supplier->id)
//             if ($supplier->id == $supplier->id) { // Compare supplier ID to itself (always true)
//                 // Group order items by product name for each order
//                 $productName = $item->product_name;

//                 if (!isset($groupedOrderItems[$productName])) {
//                     $groupedOrderItems[$productName] = [];
//                 }

//                 $groupedOrderItems[$productName][] = $item;
//             }
//         }
//     }

//     return view($this->supplier . '.dashboard.vieworder', [
//         'orders' => $orders,
//         'groupedOrderItems' => $groupedOrderItems,
//     ]);
// }

// public function showOrderSupplier($desiredSupplierId)
// {
//     dd('helo');
//     // Retrieve order items related to the desired supplier and orders with 'ordered' status
//     $orderItems = OrderItem::whereHas('product.supplier', function ($query) use ($desiredSupplierId) {
//         $query->where('id', $desiredSupplierId);
//     })->whereHas('order', function ($query) {
//         $query->where('Order_status', 'ordered');
//     })->get();
// // dd($orderItems);
//     return view($this->supplier . '.dashboard.vieworder', [
//         'orderItems' => $orderItems,
//     ]);
// }

// public function showOrderSupplier($supplierId) {
//     $orderItems = DB::table('orderitems')
//         ->join('suppliers', 'suppliers.id', '=', 'orderitems.supplierId')
//         ->join('orders', 'orders.id', '=', 'orderitems.order_id')
//         ->where('orders.order_status', 'ordered')
//         ->where('suppliers.id', $supplierId)
//         ->select('orderitems.*')
//         ->get();
// dd($orderItems);
//     return view($this->supplier . '.vieworder', compact('orderItems'));
// }


public function showOrderSupplier() {
    // Get the ID of the authenticated user (supplier)
    $supplierId = Auth::guard('supplier')->id();

    // Retrieve order items for the authenticated supplier and orders with "ordered" status
    $orderItems = DB::table('orderitems')
        ->join('orders', 'orderitems.order_id', '=', 'orders.id')
        ->where('orderitems.supplierId', $supplierId)
        ->where('orderitems.supply_status', 'Not_supplied')
        ->where('orders.order_status', 'ordered')
        ->select('orderitems.*')
        ->orderByDesc('orderitems.id') // Sort by order item ID in descending order
        ->paginate(10);
    return view($this->supplier . '.dashboard.vieworder', compact('orderItems'));
}

}
