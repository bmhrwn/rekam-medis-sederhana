<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function index(){
        return view('auth.login');
    }
   
    public function login(Request $request){
        
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        $credentials = $request->only('email','password');

        $login = Auth::attempt($credentials);

        if($login == false){
            return redirect()->route('auth')->with('failed','wrong email or password.');
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        
        $request->session()->invalidate();

        return redirect('/');
    }
}
