<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(): string
    {
        return view('admin.index');
    }

    public function login(Request $request, AdminService $adminService)
    {
        if ($request->isMethod('GET')){
            if (Auth::check()){
                return redirect()->route('admin.dashboard');
            }
            return view('admin.login');
        }
        return $adminService->login($request);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
