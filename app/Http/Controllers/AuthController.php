<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Handle login for karyawan
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'nik' => 'required|exists:karyawan,nik', // Ensure nik exists in the karyawan table
            'password' => 'required',
        ]);

        $credentials = $request->only('nik', 'password');

        // Attempt login using the 'karyawan' guard
        if (Auth::guard('karyawan')->attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Redirect to the intended page (dashboard)
        }

        // If authentication fails
        return back()->withErrors(['nik' => 'These credentials do not match our records.']);
    }

    // Handle logout for karyawan
    public function logout()
    {
        Auth::guard('karyawan')->logout();  // Log out the karyawan user
        return redirect('/');  // Redirect to the homepage or login page
    }
}
