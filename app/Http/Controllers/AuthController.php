<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::add($request->all());
        $user->genPass($request->get('password'));

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('pages.login');
    }
    public function loginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status == User::IS_BANNED) {
                Auth::logout();
                return redirect()->back()->withErrors(['message' => 'Your account is banned.']);
            }
            return redirect('/');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid credentials.']);
        
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        // if(Auth::attempt([
        //             'email' => $request->get('email'),
        //             'password' => $request->get('password')
        //         ]))
        //     {
        //         return redirect('/');
        //     }
        //     return redirect()->back()->with('status', 'Неправильный логин или пароль');
        
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
