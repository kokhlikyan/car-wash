<?php

namespace App\Services;

use App\Enum\UserRoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminService
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials = [...$credentials, 'role' => UserRoleEnum::ADMIN];
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
