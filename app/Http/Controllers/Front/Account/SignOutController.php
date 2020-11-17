<?php

namespace App\Http\Controllers\Front\Account;

use App\Http\Controllers\Controller;

class SignOutController extends Controller
{
    public function do()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
