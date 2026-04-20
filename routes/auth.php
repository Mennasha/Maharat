<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/login', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if (in_array($role, ['admin','super_admin'])) return redirect()->route('admin.dashboard');
        return redirect()->route('client.dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        $role = Auth::user()->role;
        if (in_array($role, ['admin','super_admin'])) return redirect()->intended(route('admin.dashboard'));
        return redirect()->intended(route('client.dashboard'));
    }

    return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->onlyInput('email');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password'],
        'role' => 'client',
    ]);

    \App\Models\Client::create([
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);

    Auth::login($user);
    return redirect()->route('client.dashboard');
});
