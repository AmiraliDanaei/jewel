<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendLoginCode;

class AuthenticatedSessionController extends Controller
{
    
    public function create()
    {
        return view('auth.login');
    }

    
    public function sendCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $code = random_int(100000, 999999);
            $user->login_code = $code;
            $user->login_code_expires_at = now()->addMinutes(10);
            $user->save();

            Mail::to($user->email)->send(new SendLoginCode($code));

            return redirect()->route('verify.form')->with('email', $user->email);
        }

        return back()->withErrors(['email' => 'We could not find a user with that email address.']);
    }

    
    public function showVerifyForm()
    {
        if (!session('email')) {
            return redirect()->route('login');
        }
        return view('auth.verify-code');
    }

    
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'login_code' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)
                    ->where('login_code', $request->login_code)
                    ->where('login_code_expires_at', '>', now())
                    ->first();

        if ($user) {
            
            $user->login_code = null;
            $user->login_code_expires_at = null;
            $user->save();

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->intended(route('home', absolute: false));
        }

        return back()->withErrors(['login_code' => 'The provided code is invalid or has expired.']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
