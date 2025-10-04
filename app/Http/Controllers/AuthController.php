<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success','Login successful!');
        }

        return back()->withErrors([
            'email'=>'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    // Show registration form
     public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create user
        $user = User::create([
            'name' => $data['user_name'],
            'user_name' => $data['user_name'], // <-- add this line
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'company',
        ]);

        // Create company
        Company::create([
            'user_id' => $user->id,
            'name' => $data['company_name'],
            'email' => $data['email'],
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Company account created successfully!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success','You have been logged out.');
    }
}
