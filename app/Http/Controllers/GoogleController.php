<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Socialite;
use Illuminate\Container\Attributes\Auth;

class GoogleController extends Controller
{
    // 1. Arahkan user ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Handle data balikan dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user dengan google_id ini sudah ada?
            $finduser = User::where('google_id', $googleUser->id)->first();

            if ($finduser) {
                // Jika ada, langsung login
                auth()->login($finduser);
                return redirect()->intended('dashboard');
            } else {
                // Cek apakah email sudah ada (tapi belum connect google)?
                $existingUser = User::where('email', $googleUser->email)->first();

                if ($existingUser) {
                    // Update google_id nya
                    $existingUser->update(['google_id' => $googleUser->id]);
                    Auth::login($existingUser);
                } else {
                    // Jika belum ada sama sekali, buat user baru
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => bcrypt('123456dummy') // Password random dummy
                    ]);
                    auth()->login($newUser);
                }

                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google.');
        }
    }
}
