<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function show()
    {
        return view('front.contact.show');
    }
}
