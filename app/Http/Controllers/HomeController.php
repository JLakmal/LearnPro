<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role === 'instructor') {
            return view('instructor.dashboard');
        } elseif (Auth::user()->role === 'student') {
            return view('student.dashboard');
        }

        return abort(403, 'Unauthorized action.');
    }
}
