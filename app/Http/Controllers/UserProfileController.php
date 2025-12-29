<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class UserProfileController extends Controller
{
    /**
     * Update user profile information and photo.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validate Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // 2. Check for changes
        if ($user->name === $request->name && $user->email === $request->email && !$request->hasFile('photo')) {
            return redirect()->back()->withErrors(['message' => 'Tidak ada perubahan pada data Anda.']);
        }

        // 3. Update Name & Email
        $user->name = $request->name;
        $user->email = $request->email;

        // 4. Update Photo if provided
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }
            $user->photo = $request->file('photo')->store('profile_photos', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}

