<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginPost(Request $request)
    {
        // Validasyon
        $request->validate([
            'email' => 'required|email',
            'pass'  => 'required'
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->pass
        ];

        // Auth denemesi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // Başarısız giriş
        return back()->withErrors([
            'email' => 'Email veya parola hatalı.'
        ]);
    }
}
