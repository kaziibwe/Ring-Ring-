<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    // declaring the variable for this moment
    protected $admin;

    public function __construct()
    {
        // Define the $admin variable here
        $this->admin = 'admin';
    }


 //show managegory

    public function showManageFeedback()
    {
        return view($this->admin . '.dashboard.managefeedback');
    }
}
