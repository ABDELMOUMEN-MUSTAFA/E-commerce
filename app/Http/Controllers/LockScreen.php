<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class LockScreen extends Controller
{
    public function lock()
    {
        if(auth()->check()){
            $user = auth()->user();
            Session::flush();
            Auth::logout();
            session(['name' => $user->first_name]);
            session(['email' => $user->email]);
        }
        
        return view('auth.lock');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => [
                'required',
                function($attribure, $value, $fail) use ($request) {
                    if (!Auth::attempt(['email' => $request->email, 'password' => $value])) {
                        // Authentication Not passed... 
                        $fail('These credentials do not match our records.');
                    }
                }
            ] 
        ]);

        // Successfuly Authenticated
        Session::forget('name');
        Session::forget('email');
        return redirect()->route('home');
    }
}
