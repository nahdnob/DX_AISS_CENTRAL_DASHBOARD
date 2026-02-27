<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class systemManagerController extends Controller
{
    public function index()
    {
        return view('system-managers.index');
    }
}
