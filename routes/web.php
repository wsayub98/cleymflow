<?php

use App\Modules\Auth\Http\Controllers\AuthController;
use App\Modules\Users\Http\Controllers\UserController;
use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* Route::inertia('/', 'Home', [ */
/* 'users' => User::paginate(5, ['id', 'avatar', 'name', 'email', 'created_at'], "Home", 1, 30) */
/*     'users' => User::all() */
/* ])->name('home'); */

Route::get('/', function (Request $request) {
    $users = Inertia::defer(function () use ($request) {
        $query = User::when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        });
        return $query->paginate(5)->withQueryString();
    });

    return Inertia::render('Home', [
        'users' => $users,
        'searchTerm' => $request->search,
        'can' => [
            'delete_user' => Auth::user()?->can('delete', User::class),
        ]
    ]);
})->name('home');

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/users', [UserController::class, 'list'])->name('users.list');

Route::get('/{id?}', [UserController::class, 'show'])->name('home');
