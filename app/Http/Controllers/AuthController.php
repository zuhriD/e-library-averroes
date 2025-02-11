<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

   public function login(Request $request): RedirectResponse {
 
        $credetials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credetials)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);

   }

   public function register(Request $request): RedirectResponse {
 
        $credetials = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credetials['password'] = bcrypt($credetials['password']);
        $user = User::create($credetials);

        if($user){
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'error' => 'Registration failed'
        ]);
   }

   public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
   }
}
