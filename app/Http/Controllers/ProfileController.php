<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Transaction;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function verify(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->needsPasswordSetup()) {
            return redirect()->route('profile.change-password')
                ->with('warning', 'Akun Anda dibuat melalui Google. Buat password lokal terlebih dahulu agar bisa verifikasi perubahan.');
        }

        $request->validate([
            'password' => 'required'
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Kata sandi tidak valid']);
        }

        // Set session untuk izinkan edit
        session(['profile_edit_allowed' => true]);
        
        // Debug: log session
        \Illuminate\Support\Facades\Log::info('Profile edit allowed - Session set for user: ' . $user->user_id);

        // Redirect ke form edit - PASTIKAN route name benar
        return redirect()->route('profile.edit.form');
    }

    public function showEditForm()
    {
        \Illuminate\Support\Facades\Log::info('Accessing showEditForm - Session data:', session()->all());
        
        if (!session('profile_edit_allowed')) {
            \Illuminate\Support\Facades\Log::warning('Profile edit not allowed - redirecting to profile.edit');
            return redirect()->route('profile.edit')->withErrors(['password' => 'Silakan verifikasi kata sandi terlebih dahulu']);
        }

        $user = Auth::user();
        \Illuminate\Support\Facades\Log::info('Showing edit form for user: ' . $user->user_id);
        return view('profile.update', compact('user'));
    }

    public function update(Request $request)
    {
        if (!session('profile_edit_allowed')) {
            return redirect()->route('profile.edit')->withErrors(['password' => 'Sesi edit telah berakhir. Silakan verifikasi ulang.']);
        }

        /** @var User $user */
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

    // Tampilkan form ubah password
    public function showChangePasswordForm()
    {
        $user = Auth::user();

        return view('profile.change-password', [
            'needsPasswordSetup' => $user->needsPasswordSetup(),
        ]);
    }

    // Proses update password
    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $needsSetup = $user->needsPasswordSetup();

        $rules = [
            'new_password' => 'required|min:8|confirmed',
        ];

        if (! $needsSetup) {
            $rules['current_password'] = 'required';
        }

        $validated = $request->validate($rules);

        if (! $needsSetup && ! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak valid.']);
        }

        $user->forceFill([
            'password' => Hash::make($validated['new_password']),
            'must_set_password' => false,
            'password_set_at' => now(),
        ])->save();

        $message = $needsSetup ? 'Password lokal berhasil dibuat! Silakan gunakan password ini untuk verifikasi selanjutnya.' : 'Password berhasil diubah!';

        return redirect()->route('profile.edit')->with('success', $message);
    }

    public function orders()
    {
        $user = Auth::user();
        
        // Ambil transactions dengan relasi yang diperlukan
        $transactions = Transaction::with([
            'rentals.details.item',
            'buys.detailBuys.item',
            'rentals.ratings' => function($query) use ($user) {
                $query->where('user_id', $user->user_id);
            },
            'buys.ratings' => function($query) use ($user) {
                $query->where('user_id', $user->user_id);
            }
        ])
        ->where('user_id', $user->user_id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('profile.orders', compact('transactions'));
    }
}