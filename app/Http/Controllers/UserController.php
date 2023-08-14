<?php
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index2(Request $request)
    {
        $users = User::select("*")->paginate(10);
        return view('users', compact('users'));
    }

    public function sendEmail(Request $request)
    {
        $userIds = $request->ids; // Assuming you have selected user IDs from the frontend

        $users = User::whereIn("id", $userIds)->get();
      
        // Send an email to each user
        foreach ($users as $user) {
            Mail::to($user->email)->send(new UserEmail($user));
        }

        return response()->json(['success' => 'Emails sent successfully.']);
    }
}
