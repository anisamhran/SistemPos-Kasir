<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function login(){
        return view('login');
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function login_proses(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'idrole' => 'required|numeric', // Assuming idrole is the field for role
            'username' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('dashboard'); // Redirect to the intended URL after successful login
        } else {
            // Authentication failed
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }


}
