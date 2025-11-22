<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Kata sandi tidak valid']);
        }

        // Set session untuk izinkan edit
        session(['profile_edit_allowed' => true]);
        
        // Debug: log session
        \Log::info('Profile edit allowed - Session set for user: ' . $user->user_id);

        // Redirect ke form edit - PASTIKAN route name benar
        return redirect()->route('profile.edit.form');
    }

    public function showEditForm()
    {
        \Log::info('Accessing showEditForm - Session data:', session()->all());
        
        if (!session('profile_edit_allowed')) {
            \Log::warning('Profile edit not allowed - redirecting to profile.edit');
            return redirect()->route('profile.edit')->withErrors(['password' => 'Silakan verifikasi kata sandi terlebih dahulu']);
        }

        $user = Auth::user();
        \Log::info('Showing edit form for user: ' . $user->user_id);
        return view('profile.update', compact('user'));
    }

    public function update(Request $request)
    {
        if (!session('profile_edit_allowed')) {
            return redirect()->route('profile.edit')->withErrors(['password' => 'Sesi edit telah berakhir. Silakan verifikasi ulang.']);
        }

        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'nullable|email|max:100',
            'full_name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->update($validated);

        // Clear session setelah update berhasil
        session()->forget('profile_edit_allowed');

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}