<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth
use App\Models\User; // Import User model if used directly

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id()) // Check if the user is authenticated
        {
            $usertype = Auth::user()->usertype; // Access the usertype
            if ($usertype == 'user') {
                return view('dashboard'); // Redirect to user dashboard
            } else if ($usertype == 'admin') {
                return view('admin.index'); // Redirect to admin panel
            }
        }

        return redirect()->route('login'); // Redirect to login if not authenticated
    }
}