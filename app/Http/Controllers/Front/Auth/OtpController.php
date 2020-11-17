<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\Otp;
use App\Services\Sms\Sms;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function show()
    {
        return view('front.auth.otp.show');
    }

    /**
     * @param Request $request
     * @param Sms $sms
     * @param Otp $otp
     * @return RedirectResponse
     * @throws Exception
     */
    public function generate(Request $request, Sms $sms, Otp $otp)
    {
        $request->validate([
            'cellphone' => ['required', 'cellphone'],
        ]);

        $cellphone = $request->input('cellphone');
        session(['otp:cellphone' => $cellphone]);

        if ($otp->exist($cellphone) == false) {
            $code = $otp->generate($cellphone);

            $sms->send($cellphone, trans('sms.otp', ['code' => $code]));
        }

        return redirect()->route('auth.otp.enter');
    }

    public function enter(Otp $otp)
    {
        $cellphone = session('otp:cellphone');
        if (empty($cellphone)) {
            return redirect()->route('auth.otp.show');
        }

        $ttl = $otp->ttl($cellphone);
        if ($ttl == 0) {
            return redirect()->route('auth.otp.show');
        }

        return view('front.auth.otp.enter', [
            'cellphone' => $cellphone,
            'ttl' => $otp->ttl($cellphone),
        ]);
    }

    public function submit(Request $request, Otp $otp)
    {
        $request->validate([
            'code' => ['required'],
        ]);

        $cellphone = session('otp:cellphone');
        if (empty($cellphone)) {
            return redirect()->route('auth.otp.show');
        }

        $code = $request->input('code');

        if ($otp->check($cellphone, $code)) {
            $user = User::firstOrCreate([
                'cellphone' => $cellphone,
            ]);

            auth()->login($user, true);

            return redirect()->route('home');
        }

        return back()->with('error', trans('e.invalid-otp-code'));
    }
}
