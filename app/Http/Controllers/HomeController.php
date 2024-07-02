<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

// Для использования вашей пользовательской вьюшки
Paginator::defaultView('vendor.pagination.custom');

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(7);
        return view('pages.index', ['posts' => $posts]);
    }
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('pages.show', compact('post'));
    }


}

