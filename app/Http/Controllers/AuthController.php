<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        
        if (Auth::check()) {  // Jika pengguna sudah login, redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');
            
            // Temukan user berdasarkan username
            $user = \App\Models\UserModel::where('username', $credentials['username'])->first();

            if ($user && $user->password === $credentials['password']) {
                // Jika username dan password cocok (tidak hash), login
                Auth::login($user);

                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }
            
            // Jika login gagal
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        
        // Invalidasi session dan generate ulang token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman login
        return redirect('login')->with('success', 'Logout berhasil.');
    }

}
