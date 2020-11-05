<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class SignOutController extends Controller
{
    public function do()
    {
        session()->put('admin', 0);
        return redirect()->route('admin.auth.sign-in.show');
    }
}
