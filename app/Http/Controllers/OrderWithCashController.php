<?php

namespace App\Http\Controllers;
use App\Models\order;


use Illuminate\Http\Request;

class OrderWithCashController extends Controller
{
    //

      // declaring the variable for this moment
      protected $admin;

      public function __construct()
      {
          // Define the $admin variable here
          $this->admin = 'admin';
      }


   //show manage order with cash

      public function showManageOrderWithCash()
      {
          return view($this->admin . '.dashboard.manageorderwithcash'
          , [
            'orders' => Order::where('payment_mode', '!=', 'pay_on_delivery') // Exclude 'pay_on_delivery' orders
                ->latest('id')
                ->paginate(20),
        ]);
      }


}
