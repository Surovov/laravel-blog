<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile', ['user' => $user]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                 Rule::unique('users')->ignore(Auth::user()->id),
             ],
            'avatar' => 'nullable|image'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }    
        
        $user = Auth::user();
        $user->edit($request->all());
        $user->genPass($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        return redirect()->back()->with('status', 'Профиль успешно обновлен');
    }
}
