<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pattern;
use App\Models\Sensor;

class SettingController extends Controller
{
    public function index()
    {
        $patterns = Pattern::with('sensors:id,name')->get();
        $sensors  = Sensor::all();

        return view('settings.index', compact('patterns', 'sensors'));
    }
}
