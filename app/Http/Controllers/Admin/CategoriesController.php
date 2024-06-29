<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category; // Добавьте правильный путь к модели
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoriesController extends Controller
{
    public function index()
    {   
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('categories.create')
                ->withErrors($validator)
                ->withInput();
        }

        Category::create($request->all());
        return redirect()->route('categories.index');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['category'=>$category]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->route('categories.edit')
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
