<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post; 
use App\Models\Tag;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::pluck('title', 'id')->all();
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.posts.create', compact(
            'categories',
            'tags',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'image' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            return redirect()->route('posts.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Получение всех данных формы
        $data = $request->all();
        // Проверка состояния чекбоксов
        $status = $request->has('status') ? 1 : 0;
        $is_featured = $request->has('is_featured') ? 1 : 0;

        // Создание поста с обновленными данными
        $post = Post::add($data);
        $post->uploadImage($request->file('image'));

        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        
        $post->toggleStatus($status);
        $post->toggleFeatured($is_featured);

        return redirect()->route('posts.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $tags = Tag::pluck('title', 'id')->all();
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.posts.edit', compact(
            'categories',
            'tags',
            'post',
        ));
        return view('admin.posts.edit', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
         */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->route('posts.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Получение всех данных формы
        $data = $request->all();
        // Проверка состояния чекбоксов
        $status = $request->has('status') ? 1 : 0;
        $is_featured = $request->has('is_featured') ? 1 : 0;

        // Обновление поста с новыми данными
        $post->edit($data);
        $post->uploadImage($request->file('image'));

        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));

        $post->toggleStatus($status);
        $post->toggleFeatured($is_featured);

        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->remove();
        return redirect()->route('posts.index');
    }




}
