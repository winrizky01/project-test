<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class AuthController extends Controller
{
    public function index(){
        $view = "auth";
        
        return view($view);
    }

    // Tangani proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirect ke halaman dashboard setelah login
            return redirect('/');
        }

        // Kembali ke halaman login jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function register()
    {
        $users = [
            [
                "name"      => "development",
                "email"     => "development@gmail.com",
                "password"  => bcrypt("12345678"),
                "status"    => "active",
                "role"      => "superadmin",
                'created_at'=> date('Y-m-d H:i:s'),
            ],            
            [
                "name"      => "admin",
                "email"     => "admin@gmail.com",
                "password"  => bcrypt("12345678"),
                "status"    => "active",
                "role"      => "admin",
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                "name"      => "approval_1",
                "email"     => "approval_1@gmail.com",
                "password"  => bcrypt("12345678"),
                "status"    => "active",
                "role"      => "approver",
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                "name"      => "approval_2",
                "email"     => "approval_2@gmail.com",
                "password"  => bcrypt("12345678"),
                "status"    => "active",
                "role"      => "approver",
                'created_at'=> date('Y-m-d H:i:s'),
            ]
        ];

        foreach ($users as $user) {
            User::create(array_merge($user, ['created_at' => now()]));
        }
        
    }

    // Tangani proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
