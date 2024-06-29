<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; // Добавьте правильный путь к модели
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                'email' => 'required|email|unique:users,email,' . $id,
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




        public function destroy($id)
        {
            User::find($id)->remove();
            return redirect()->route('users.index');
        }
}
