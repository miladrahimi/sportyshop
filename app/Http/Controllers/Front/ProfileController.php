<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('front.profile.show', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->save();

        return back()->with('success', trans('e.profile-updated'));
    }
}
