<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        // Add your admin-specific logic here
        return view('admin.dashboard'); // Assuming you have an admin dashboard view
    }
}
