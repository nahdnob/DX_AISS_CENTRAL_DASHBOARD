<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function create()
    {
        return view('register');
    }
}
