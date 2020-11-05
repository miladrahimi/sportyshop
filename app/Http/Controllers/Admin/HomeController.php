<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function show()
    {
        return view('admin.home');
    }
}
