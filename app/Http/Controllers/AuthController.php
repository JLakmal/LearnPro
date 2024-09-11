<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:instructor,student',
            // 'role'=>'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        if ($request->ajax()) {
            return response()->json(['message' => 'Registration successful!'], 200);
        }

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
      // Show login form
      public function showLoginForm()
      {
          return view('auth.login');
      }

     // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Login successful!'], 200);
            }
            return redirect()->route('courses.index'); // Redirect to the course index route after login
        }

        if ($request->ajax()) {
            return response()->json(['errors' => ['email' => ['Invalid credentials.']]], 422);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
