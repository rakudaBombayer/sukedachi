<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nickname' => ['required', 'string', 'max:50'], // max:50 を追加
            'address' => ['required', 'string'], // address は必須
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:'.User::class], // max:100 を追加
            'self_introduction' => ['required', 'string'], // self_introduction は必須
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($request->all());
        
        $user = User::create([
            'nickname' => $request->nickname, // DBのカラム名と合わせる
            'address' => $request->address,   // DBのカラム名と合わせる
            'email' => $request->email,
            'self_introduction' => $request->self_introduction, // DBのカラム名と合わせる
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('index');
    }
}