<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if(!$user){
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(16)), // Random password for social login
                    'email_verified_at' => now()
                ]);
            } else {
                // Link google id if existing user logs in via google for the first time
                if(empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }

            Auth::login($user);

            return redirect('/home');

        } catch (\Throwable $th) {
             return redirect()->route('login')->with('error', 'Something went wrong with Google Login: ' . $th->getMessage());
        }
    }
}
