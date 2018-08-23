<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
//use App\Http\Request;

class SessionsController extends Controller
{
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
            // 登录成功后的相关操作
            session()->flash('success', 'welcome back ~ mew');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            //登录失败后的操作
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
