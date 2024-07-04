<?php

namespace App\Http\Controllers\Admin;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', ['comments' =>$comments]);
    }
    public function toggle($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->toggleStatus();
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        Comment::find($id)->remove();
        return redirect()->back();
    }
    
}
