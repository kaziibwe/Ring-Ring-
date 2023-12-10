<?php

namespace App\Http\Controllers;
use App\Models\order;


use Illuminate\Http\Request;

class PayOnDeliveryController extends Controller
{
    //
       // declaring the variable for this moment
       protected $admin;

       public function __construct()
       {
           // Define the $admin variable here
           $this->admin = 'admin';
       }


    //show manage pay on delivary

       public function showManagePayOnDelivery()
       {
           return view($this->admin . '.dashboard.managepayondelivery', [
            'orders' => Order::where('payment_mode','pay_on_delivery')->latest('id')->paginate(20)
        ]);
       }


}
