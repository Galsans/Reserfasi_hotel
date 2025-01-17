<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileEditController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'current_password' => 'required_with:password',
            // 'phone' => 'required|numeric',
            // 'img' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->filled('password')) {
            // Verify the current password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->route('profile.edit')->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->alamat = $request->alamat;

        // if ($request->hasFile('img')) {
        //     // Delete the old image if exists
        //     if ($user->img) {
        //         Storage::delete($user->img);
        //     }
        //     // Store the new image
        //     $user->img = $request->file('img')->store('public/user');
        // }

        $user->save();

        return redirect()->route('')->with('success', 'Profile updated successfully.');
    }
}
