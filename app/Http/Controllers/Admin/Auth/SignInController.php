<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function show()
    {
        return view('admin.auth.sign-in');
    }

    public function do(Request $request)
    {
        if (
            $request->input('username') == config('admin.auth.username') &&
            $request->input('password') == config('admin.auth.password')
        ) {
            session()->put('admin', 1);
            return redirect()->route('admin.home.show');
        }

        return back()->with('error', trans('auth.failed'));
    }
}
