<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    protected array $roles = [
        'admin' => 'Administrator',
        'staff' => 'Staff / Operator',
    ];

    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users-index', [
            'users' => $users,
            'roles' => $this->roles,
        ]);
    }

    public function create()
    {
        return view('users-create', ['roles' => $this->roles]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:admin,staff'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User baru berhasil dibuat.');
    }

    public function edit(User $user)
    {
        return view('users-edit', [
            'user' => $user,
            'roles' => $this->roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,staff'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        $message = 'User berhasil diperbarui.';

        if (auth()->id() === $user->id && ($data['role'] ?? $user->role) !== 'admin') {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('login')->with('status', 'Role Anda berubah menjadi staff. Silakan login kembali.');
        }

        return redirect()->route('users.index')->with('success', $message);
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
