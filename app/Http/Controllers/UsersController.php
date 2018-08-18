<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Request;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
}
