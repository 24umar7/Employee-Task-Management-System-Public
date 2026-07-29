<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login User
public function login(Request $request)
{
    //  dd('Controller reached');
    $username = trim($request->username);
    $password = trim($request->password);

    $user = User::where('username', $username)->first();

    if ($user && Hash::check($password, $user->password)) {

        Auth::login($user);

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('employee.dashboard');
    }

    return back()->with('error', 'Invalid username or password.');
}
    // Logout User

public function logout(Request $request)
{
    Auth::logout();
    return redirect()->route('login');
}

public function redirectToGoogle()
{
    return Socialite::driver('google')
    ->with(['prompt' => 'select_account'])
    ->redirect();
}

public function handleGoogleCallback()
{
    try {

        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        // Employee is not registered
        if (!$user) {

            return redirect()->route('login')
                ->with('error', 'Your email is not registered. Please contact the administrator.');
        }

        // Extra safety: only employees may use Google login
        if ($user->role != 'employee') {

            return redirect()->route('login')
                ->with('error', 'Google login is only available for employees.');
        }

        Auth::login($user);

        return redirect()->route('employee.dashboard');

    } catch (\Exception $e) {

        return redirect()->route('login')
            ->with('error', 'Google authentication failed.');
    }
}
    
    public function redirectToGithub()
{
    return Socialite::driver('github')
    ->with(['prompt' => 'select_account'])
    ->redirect();
}

public function handleGithubCallback()
{
    try {

        $githubUser = Socialite::driver('github')->user();

        $user = User::where('email', $githubUser->getEmail())->first();

        // Employee is not registered
        if (!$user) {

            return redirect()->route('login')
                ->with('error', 'Your email is not registered. Please contact the administrator.');
        }

        // Only employees can login with GitHub
        if ($user->role != 'employee') {

            return redirect()->route('login')
                ->with('error', 'GitHub login is only available for employees.');
        }

        Auth::login($user);

        return redirect()->route('employee.dashboard');

    } catch (\Exception $e) {

        return redirect()->route('login')
            ->with('error', 'GitHub authentication failed.');
    }
}
}