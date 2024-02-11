<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class BackViewController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function coming_soon()
    {
        return view('coming_soon');
    }
}
