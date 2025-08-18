<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Hanya role Sekretaris yang bisa mengakses
        if (Auth::user()->role !== 'Sekretaris') {
            abort(403, 'Unauthorized action.');
        }

        // Ambil semua user kecuali diri sendiri
        $users = User::where('id', '!=', Auth::id())->get();

        return view('users.index', compact('users'));
    }

    public function promote(User $user)
    {
        // Hanya role Sekretaris yang bisa mengakses
        if (Auth::user()->role !== 'Sekretaris') {
            abort(403, 'Unauthorized action.');
        }

        // Validasi bahwa user target bukan diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa mengubah role diri sendiri.');
        }

        // Ubah role user target menjadi Sekretaris
        $user->update(['role' => 'Sekretaris']);

        return back()->with('success', 'Role user berhasil diubah menjadi Admin.');
    }

    public function demote(User $user)
    {
        // Hanya role Sekretaris yang bisa mengakses
        if (Auth::user()->role !== 'Sekretaris') {
            abort(403, 'Unauthorized action.');
        }

        // Validasi bahwa user target bukan diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa mengubah role diri sendiri.');
        }

        // Ubah role user target menjadi Sekretaris
        $user->update(['role' => 'Warga']);

        return back()->with('success', 'Role user berhasil diubah menjadi Warga.');
    }
}
