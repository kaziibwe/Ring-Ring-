<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    //      // declaring the variable for this moment
    //      protected $admin;

    //      public function __construct()
    //      {
    //          // Define the $admin variable here
    //          $this->admin = 'admin';
    //      }


    //   //show manage order

    //      public function showManageOrder()
    //      {
    //          return view($this->admin . '.dashboard.manageorder',[
    //             'orders'=>order::latest('id')->paginate(20)
    //         ]);
    //      }


    protected $admin = 'admin';
    protected $store = 'store';

    public function __construct()
    {
        // Define the $admin and $store variables here
        // You can keep these definitions if they are used in other parts of your controller
        $this->admin = 'admin';
        $this->store = 'store';
    }

    public function showManageOrder()
    {
        return view($this->admin . '.dashboard.manageorder', [
            'orders' => Order::latest('id')->paginate(20)
        ]);
    }

    // controller to view the dashboard of the  store manager
    public function showStoreManageOrder()
    {
        return view($this->store . '.dashboard.indexStore');
    }

    public function showStoreOrder()
    {
        return view($this->store . '.dashboard.manageorderstore', [
            'orders' => Order::latest('id')->paginate(20)
        ]);
    }



    public function OrderDetail(order $order)
    {
        // Load the correct relationship for sizes
        $order->load(['orderitems']);
        return view($this->admin . '.dashboard.manageorderdetail', compact('order'));
    }

    public function OrderDetailStore(order $order)
    {
        // Load the correct relationship for sizes
        $order->load(['orderitems']);
        return view($this->store . '.dashboard.manageorderdetailstore', compact('order'));
    }

    // controller to set the order to be seen by the delivery man
    public function updateOrderProgress(Request $request, Order $order)
    {
        $randomNumber = mt_rand(10000000, 99999999);

        // Assuming 'Order_status' is the name of the column in the orders table
        $formAddOrder = [
            'Order_status' => 'Processed',
            'Order_number' => $randomNumber,

        ];

        DB::table('orders')->where('id', $order->id)->update($formAddOrder);

        // Optionally, you can check if the update was successful
        if (DB::table('orders')->where('id', $order->id)->update($formAddOrder)) {
            return back()->with('success', 'Order status updated to "Processed"');
        } else {
            return back()->with('error', 'Failed to update order status');
        }
    }

//  controller to update the order table to ondelivery

public function storePreparedorder(Request $request, Order $order)
{
    // Retrieve the order ID from the request
    $orderId = $request->input('order_id');

    // Update the order status to 'On Delivery' in the orders table
    $updated = DB::table('orders')
        ->where('id', $orderId)
        ->update(['Order_status' => 'On Delivery']);

    // Check if the update was successful
    if ($updated) {
        // Insert a new record into the deliveries table
        $deliveryId = DB::table('deliveries')->insertGetId([
            'deliveryman_id' => auth('deliveryman')->user()->id,
            'order_id' => $orderId,
            'selectorderdate' => now()->format('d-m-y h:i:s'),
        ]);

        if ($deliveryId) {
            // If both the update and insert were successful, return a success message
            return back()->with('success', 'Order status updated to "On Delivery"');
        } else {
            // If the update was successful but the insert failed, return an error message
            return back()->with('danger', 'Failed to insert delivery record');
        }
    } else {
        // If the update failed, return an error message
        return back()->with('danger', 'Failed to update order status');
    }
}





    // public function OrderRelated()
    // {
    //     // Retrieve all orders with an 'ordered' status
    //     // $orders = Order::where('order_status', 'ordered')->get();
    //     $orders = Order::where('order_status', 'ordered')->paginate(20); // Change the '20' to the desired number of orders per page


    //     // Initialize an empty array to store grouped order items
    //     $groupedOrderItems = [];

    //     foreach ($orders as $order) {
    //         // Group order items by product name for each order
    //         $groupedOrderItems[$order->id] = $order->orderItems->groupBy('product_name');
    //     }

    //     return view($this->store . '.dashboard.managerelatedorder', [
    //         'orders' => $orders,
    //         'groupedOrderItems' => $groupedOrderItems,
    //     ]);
    // }

    // public function OrderPrepared()
    // {
    //     // Retrieve all orders with an 'ordered' status
    //     $orders = Order::where('Order_status', 'ordered')->get()->paginate(10);

    //     // Initialize an empty array to store grouped order items
    //     $groupedOrderItems = [];

    //     foreach ($orders as $order) {
    //         // Get all order items for the order with 'ordered' status
    //         $orderItems = $order->orderItems()
    //             ->join('orders', 'orders.id', '=', 'orderitems.order_id')
    //             ->where('orders.Order_status', 'ordered')
    //             ->get();

    //         // Group order items by product name for each order
    //         $groupedItems = $orderItems->groupBy('product_name')->toArray();

    //         // Sort the grouped items by product name
    //         ksort($groupedItems);

    //         // Append the sorted grouped items to the result array
    //         $groupedOrderItems[$order->id] = $groupedItems;
    //     }
    //     return view($this->store . '.dashboard.managepreparedorder', [
    //         'orders' => $orders,
    //         'groupedOrderItems' => $groupedOrderItems,
    //     ]);
    // }





//         public function showOrderSupplier() {
//                 // Get the ID of the authenticated user (supplier)
//                 $supplierId = Auth::id();
//                 dd($supplierId);

//                 // Retrieve order items for the authenticated supplier and orders with "ordered" status
//                 $orderItems = DB::table('orderitems')
//                     ->join('orders', 'orderitems.order_id', '=', 'orders.id')
//                     ->where('orderitems.supplierId', $supplierId)
//                     ->where('orders.order_status', 'ordered')
//                     ->select('orderitems.*')
//                     ->get();
// dd($supplierId);
//                 return view('', compact('orderItems'));
//             }
// controller to get related products needed from the supply
    public function OrderRelated()
    {
        // Retrieve all orders with an 'ordered' status
        $orders = Order::where('Order_status', 'ordered')->get();

        // Initialize an empty array to store grouped order items
        $groupedOrderItems = [];

        foreach ($orders as $order) {
            // Get all order items for the current order
            $orderItems = $order->orderItems;

            // Group order items by product name for each order
            foreach ($orderItems as $item) {
                $productName = $item->product_name;

                if (!isset($groupedOrderItems[$productName])) {
                    $groupedOrderItems[$productName] = [];
                }

                $groupedOrderItems[$productName][] = $item;
            }
        }

        return view($this->store . '.dashboard.managerelatedorder', [
            'orders' => $orders,
            'groupedOrderItems' => $groupedOrderItems,
        ]);
    }


    // public function OrderRelated()
    // {
    //     // Retrieve all orders with an 'ordered' status
    //     $orders = Order::where('Order_status', 'ordered')->get();

    //     // Initialize an empty array to store grouped order items
    //     $groupedOrderItems = [];

    //     foreach ($orders as $order) {
    //         // Get all order items for the order with 'ordered' status
    //         $orderItems = $order->where('Order_status', 'ordered')->get();

    //         // Group order items by product name for each order
    //         $groupedItems = $orderItems->groupBy('product_name');

    //         // Sort the grouped items by product name
    //         ksort($groupedItems);

    //         // Append the sorted grouped items to the result array
    //         $groupedOrderItems[$order->id] = $groupedItems;
    //     }

    //     return view($this->store . '.dashboard.managerelatedorder', [
    //         'orders' => $orders,
    //         'groupedOrderItems' => $groupedOrderItems,
    //     ]);
    // }






    public function storeOrder(Request $request)
    {
        // Retrieve cart item data from the request
        $cartItems = $request->input('cart_items');
        $calculatedTotal = $request->input('calculated_total');
        $shipping = $request->input('shipping_fee');
        $paymentMode = $request->input('payment_mode');
        // Initialize an array to store order item data
        $orderItemsData = [];
        // Loop through $cartItems and process each item
        foreach ($cartItems as $cartItemId => $cartItem) {
            $quantity = $cartItem['quantity'];
            $supplierId = $cartItem['supplierId'];
            $productName = $cartItem['product_name'];
            $price = $cartItem['price'];
            $itemSizes = $cartItem['item_sizes'] ?? null;
            $itemColors = $cartItem['item_colors'] ?? null;
            $photo = $cartItem['photo'] ?? null; // Use null if 'photo' is not present
            // Add the item data to the order items array


            $photo = null; // Default to null if 'photo' is not present
            if (isset($cartItem['photo'])) {
                // Extract the image file name from the URL
                $photoPath = parse_url($cartItem['photo'], PHP_URL_PATH);
                $photo = 'images/' . basename($photoPath);

                $orderItemsData[] = [
                    'product_name' => $productName,
                    'quantity' => $quantity,
                    'supplierId' => $supplierId,
                    'price' => $price,
                    'item_sizes' => $itemSizes,
                    'item_colors' => $itemColors,
                    'photo' => $photo,
                ];
            }
        }


        // Validate order data
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'street' => 'required',
            'division' => 'required',
            'city' => 'required',
            'payment_mode' => 'nullable',
            'payment_id' => 'nullable', // Add validation for payment_id if needed
            // 'photo' => 'nullable|image',
            // Add other validation rules as needed
        ]);

        // Generate a random tracking number
        $trackingNo = 'Ring-' . Str::random(10);
        // dd($request->input('payment_id')) ;


//    d(now()->format('d-m-y h:i:s'));

        // Insert data into the 'orders' table
        $orderId = DB::table('orders')->insertGetId([
            'customer_id' => Auth('customer')->user()->id,
            // 'user_id' => $user->id,

            'tracking_no' => $trackingNo,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'street' => $request->input('street'),
            'division' => $request->input('division'),
            'city' => $request->input('city'),
            'Order_status' => 'ordered',
            'shipping_fee' => $shipping,
            'calculated_total' => $calculatedTotal,
            'payment_mode' => $request->input('payment_mode'),
            'payment_id' => $request->input('payment_id'), // You should have a field with this name in your form
            'orderdate' => now()->format('d-m-y h:i:s'),
        ]);

        // Insert order items into the 'orderitems' table
        foreach ($orderItemsData as $orderItem) {
            DB::table('orderitems')->insert([
                'order_id' => $orderId,
                'supply_status' => 'Not_supplied',
                'product_name' => $orderItem['product_name'],
                'quantity' => $orderItem['quantity'],
                'supplierId' => $orderItem['supplierId'],
                'photo' => $orderItem['photo'],
                'price' => $orderItem['price'],
                'item_sizes' => $orderItem['item_sizes'],
                'item_colors' => $orderItem['item_colors'],
                // Add other item details as needed
            ]);
        }

        // destroy the all session
        // $request->session()->flush();
        // To destroy a specific session variable
        $request->session()->forget('cart');
        // Determine the payment method and redirect accordingly
        if ($paymentMode === 'mobile_payment') {
            return redirect()->route('front.mobile_payment_page');
        } elseif ($paymentMode === 'pay_on_delivery') {
            return redirect()->route('font.index')->with('front_success', 'Thank You to order from RingRing .Wait for you delivery in 3 days');
        } else {
            return redirect()->route('front.cart')->with('danger', 'Please try Again with checkout at Cart Page !!!');
        }

}
}
