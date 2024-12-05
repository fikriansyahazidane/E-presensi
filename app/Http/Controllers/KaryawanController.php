<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    // Show the profile of the logged-in Karyawan
    public function show()
    {
        // Get the currently authenticated Karyawan
        $karyawan = Auth::guard('karyawan')->user();  // Use the 'karyawan' guard to fetch the authenticated user

        // Return a view that displays the profile (you need to create this view)
        return view('karyawan.profile', compact('karyawan'));
    }

    // Show the form for editing the profile
    public function edit()
    {
        // Get the currently authenticated Karyawan
        $karyawan = Auth::guard('karyawan')->user();  // Use the 'karyawan' guard to fetch the authenticated user

        // Return the view with the Karyawan's data (you need to create this view)
        return view('karyawan.edit', compact('karyawan'));
    }

    // Update the Karyawan's profile information
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
        ]);

        // Get the currently authenticated Karyawan
        $karyawan = Auth::guard('karyawan')->user();

        // Update the Karyawan's profile with the new data
        $karyawan->DB::update('update users set votes = 100 where name = ?', ['John']);([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jabatan' => $request->input('jabatan'),
            'no_hp' => $request->input('no_hp'),
        ]);

        // Redirect back with a success message
        return redirect()->route('karyawan.profile')->with('success', 'Profile updated successfully!');
    }
}
