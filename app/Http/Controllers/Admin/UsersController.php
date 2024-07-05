<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; // Добавьте правильный путь к модели
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth; // Добавлено использование фасада Auth


class UsersController extends Controller
{
    public function index()
        {   
            $users = User::all();
            return view('admin.users.index', ['users' => $users]);
        }
        public function create()
        {
            return view('admin.users.create');
        }


        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'avatar' => 'nullable|image',
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.create')
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $user = User::add($request->all());
            $user->uploadAvatar($request->file('avatar'));
            return redirect()->route('users.index');
        }



        public function edit($id)
        {
            $user = User::find($id);
            return view('admin.users.edit', ['user'=>$user]);
        }

        public function update(Request $request, $id)
        {
            $user = User::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required',
               'email' => [
                    'required',
                    'email',
                     Rule::unique('users')->ignore($user->id), // Изменено Auth::user()->id на $user->id
                 ],
                'password' => 'nullable',
                'avatar' => 'nullable|image',
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->update($request->except('password')); // исключаем поле пароля из обновления
            $user->genPass($request->get('password'));
            $user->uploadAvatar($request->file('avatar'));

            return redirect()->route('users.index');
        }

        public function toggleBan($id)
        {
            $user = User::findOrFail($id);
            $user->toggleBan(!$user->isBanned());
            return redirect()->route('users.index');
        }

        public function toggleAdmin($id)
        {
            $user = User::findOrFail($id);
            $user->toggleAdmin(!$user->is_admin);
            return redirect()->route('users.index');
        }



        public function destroy($id)
        {
            User::find($id)->remove();
            return redirect()->route('users.index');
        }
}
