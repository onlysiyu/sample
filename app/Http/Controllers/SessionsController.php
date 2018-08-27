<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
//use App\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }


    public function create()
    {
        return view('sessions.create');
    }


    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email'     => 'required|email|max:255',
            'password'  => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->activated) {
                session()->flash('success', 'welcome back ~ mew');
                return redirect()->intended(route('users.show', [Auth::user()]));
            } else {
                Auth::logout();
                session()->flash('warning', 'your account is not activated, please check the registered mail in the mailbox for activation ~ mew');
                return redirect('/');
            }
        } else {
            session()->flash('danger', 'sorry, your email and password do not match ~ mew');
            return redirect()->back();
        }
    }


     public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'you have successfully quit ~ mew');
        return redirect('login');
    }

}
