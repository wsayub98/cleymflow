<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    /* public function register(RegisterRequest $request) */
    public function register(RegisterRequest $request)
    {
        $res = AuthServices::register($request->validated());
        if (!$res['success']) abort(400, json_encode('error', $res['error']));

        /* abort(200); */
        Auth::login($res['data']);
        return redirect()->signedRoute('dashboard');
    }

    public function login(LoginRequest $request)
    {
        $isAuthenticated = AuthServices::login($request->validated());
        if (!$isAuthenticated) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        Inertia::flash([
            'message' => 'You are successfully logged in!',
        ]);
        return redirect()->intended('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
