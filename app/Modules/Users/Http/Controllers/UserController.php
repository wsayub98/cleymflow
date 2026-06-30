<?php

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show(User $user)
    {
        return Inertia::render('Home', [
            'user' => $user,
        ]);
        /* return Inertia::render('Auth/Register'); */
    }
}
