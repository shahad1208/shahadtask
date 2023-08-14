<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

use Illuminate\Support\Facades\Cache;


use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
//Function for Login page
     public function index()
    {
        return view('auth.login');
    }
//Function for Register page
    public function register_view(){
        return view('auth.register');
    }
//Function for Login
    public function login(Request $request)
    {
        // Check if there are too many login attempts from this IP within the last 5 minutes
        $ipAddress = $request->ip();
        $attemptKey = 'login_attempts_' . $ipAddress;
        
        if (Cache::has($attemptKey)) {
            return redirect()->back()->withErrors(['login' => 'Too many login attempts. Please try again later.']);
        }

        // Validate data
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Login code...
        if (\Auth::attempt($request->only('email', 'password'))) {
            $user = \Auth::user();

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            } else {
                return redirect('home'); // Redirect to user dashboard
            }
        }

        // Cache a login attempt for this IP
        Cache::put($attemptKey, true, now()->addMinutes(5)); // Cache for 5 minutes

        return redirect()->back()->withErrors(['login' => 'Invalid login credentials.']);
    }

//Function for register
    public function register(Request $request){
        // dd($request->all());

   $request->validate([
    'name' => 'required',
    'email' => 'required|unique:users|email',
    'phone' => 'required|digits_between:10,15', // Adjust the range based on the allowed length

    'image' => 'required|image', // No need for 'mimes' rule
    'password' => 'required|confirmed'
]);

$image = time() . '.' . $request->image->extension();

// Debugging: Output the original name and MIME type of the uploaded image
// dd($request->image->getClientOriginalName(), $request->image->getClientMimeType());

$request->image->move(public_path('uploads'), $image);
$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'password' => \Hash::make($request->password),
    'image' => $image // Associate the image file name with the user
]);

if (\Auth::attempt($request->only('email', 'password'))) {
    return redirect('home');
}



return redirect('register')->withError('Error');

    }

    public function home(){
                return view('home');
            }

                         public function logout(){
                \Session::flush();
                \Auth::logout();
                return redirect('');
            }


             public function adminHome()
    {
        return view('adminHome');
    }
//Function for show profile page
    public function view_profile(){
        return view('auth.profile');
    }

//Show User in Edit Form
    public function edit($id) {
    $user = User::findOrFail($id); // Fetch the user by ID
    return view('auth.editprofile', compact('user'));
}

//Function For Profile Update
 public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);

        // Update other profile fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        // $user->image = $request->input('image');

        if ($request->hasFile('image')) {
        $newImage = $request->file('image');
        $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
        $newImage->move(public_path('uploads'), $newImageName);
        $user->image = $newImageName;


    }


        $user->save();

        return redirect('/home/view-profile')->with('success', 'Profile updated successfully');
    }

//Function for Show User All
    public function usershow(){

        $users = User::all();

        return view('auth.usershow',compact('users'));
    }


    //Function for delete User

 public function destroy($id)
{
    $user = User::findOrFail($id);

    // Additional logic to delete user's image file if needed
    // ...

    $user->delete();

    return redirect('home/show-all-users')->with('success', 'User deleted successfully');
}

public function edit1($id)
{
    $user = User::findOrFail($id);
    return view('auth.editallusers', compact('user'));
}


public function updateuser(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Update other profile fields
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');

    // Handle image upload if provided
    if ($request->hasFile('image')) {
        $newImage = $request->file('image');
        $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
        $newImage->move(public_path('uploads'), $newImageName);
        $user->image = $newImageName;
    }

    // Save updated user data
    $user->save();

    return redirect('home/show-all-users')->with('success', 'User updated successfully');
}


}
