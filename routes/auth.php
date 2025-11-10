<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            if (!$user->has_completed_onboarding) {
                return redirect()->route('choose-starting-point');
            }
            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    });

    Route::get('register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('register', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'has_completed_onboarding' => false, // Ensure new users see the onboarding page
            'starting_level' => null, // Will be set when they choose a path
        ]);

        Auth::login($user);

        return redirect()->route('choose-starting-point');
    });

    Route::get('forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('forgot-password', function (\Illuminate\Http\Request $request) {
        $request->validate(['email' => 'required|email']);
        // Password reset logic would go here
        return back()->with('status', 'We have emailed your password reset link.');
    })->name('password.email');

    Route::get('reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
    })->name('password.reset');

    Route::post('reset-password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        // Password reset logic would go here
        return redirect()->route('login')->with('status', 'Your password has been reset.');
    })->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', function (\Illuminate\Http\Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

