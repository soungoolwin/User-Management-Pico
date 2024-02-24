<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'username.required' => 'Email is required.',
            'password.required' => 'Password is required.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->intended('/dashboard/users/create');
        } else {
            return back()->with('error', 'Invalid login credentials');
        }
    }
    public function signout()
    {
        try {
            Auth::logout();
            return redirect('/dashboard/login')->with('success', 'You have been successfully logged out.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred during the logout process.');
        }
    }
}
