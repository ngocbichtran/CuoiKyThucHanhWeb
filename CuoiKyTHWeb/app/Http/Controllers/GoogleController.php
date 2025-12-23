<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    // Redirect tới Google
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Callback từ Google
    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(uniqid()),
                'role' => 'user',
            ]
        );

        auth()->login($user);

            if ($user->role === 'admin') {
        return redirect('/dashboard');
    }

    return redirect('/shop');
    }
}
