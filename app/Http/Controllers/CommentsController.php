<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Auth;


class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment;
        $comment->text = $request->get('text');
        $comment->post_id = $request->get('post_id');
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()->back()->with('status', 'Коммент отправлен, скоро будет опубликован');
    }
}
