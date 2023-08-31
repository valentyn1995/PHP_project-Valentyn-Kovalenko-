<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function admin()
    {
        return view('layouts.adminlte');
    }
}