<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class DashboardController extends Controller
{
    //
    public function index()
{
    $user = Auth::user();
    $enrolledCourses = $user->enrolledCourses()->with('lessons')->get();

    return view('dashboard', compact('enrolledCourses'));
}

}
