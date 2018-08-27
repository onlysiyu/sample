<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;
//use App\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }


    public function create()
    {
        return view('users.create');
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:50',
            'email'    => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $this->sendEamilConfirmationTo($user);
        session()->flash('success', 'please check that the verification message has been sent to your registered mailbox ~ mew');
        return redirect('/');


        //Auth::login($user);
        //session()->flash('success', 'Welcom to Rabbits🐇 Planet~');
        //return redirect()->route('users.show', [$user]);
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }


    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:50',
            'password' => 'required|confirmed|min:6'
        ]);


        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', 'edit successfully ~ mew');

        return redirect()->route('users.show', $user->id);
    }


    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', 'delete rabbit successfully ~ mew');
        return back();
    }


    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }



    public function sendEamilConfirmationTo($user)
    {
        $view    = 'emails.confirm';
        $data    = compact('user');
        $from    = 'siyu9709@gmail.com';
        $name    = 'siyu';
        $to      = $user->email;
        $subject = "thanks for your registration, please confirm your eamil ~ mew";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }


    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated        = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', 'congratulations, the activation was successfully ~ mew');
        return redirect()->route('users.show', [$user]);
    }
}
