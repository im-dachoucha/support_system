<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if(!auth()->attempt($request->only('email', 'password'))){
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }
        return redirect()->route('tickets.index');
    }
}
