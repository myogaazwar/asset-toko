<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);



        return redirect()->route('register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('nik', $request->nik)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back();
        }

        Auth::login($user);

        if (Auth::user()->role === 'MANAGER') {
            return redirect()->route('assetmasuk.index');
        }

        return redirect()->route('dashboard_index')->with('success_login', 'Login berhasil!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
