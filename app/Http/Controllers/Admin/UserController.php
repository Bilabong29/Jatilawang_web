<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {

        return view('admin.users.show', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', 'in:customer,admin,staff,owner'],
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
