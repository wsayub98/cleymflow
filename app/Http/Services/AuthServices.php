<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthServices
{
    public static function register(array $params)
    {
        if ($params['avatar']) {
            $params['avatar'] = Storage::disk('public')->put('avatars', $params['avatar']);
        }

        $params['password'] = Hash::make($params['password']);
        return UserRepository::create($params);
    }

    public static function login(array $params)
    {
        $credentials = $params;
        unset($credentials['remember']);

        return Auth::attempt($credentials, $params['remember']);
    }
}
