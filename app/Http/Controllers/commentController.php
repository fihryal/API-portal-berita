<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    public function store(Request $request)
    {
        $request -> validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required'
        ]);

        $request ['user_id'] = Auth()->user()->id;

        $comment = Comment::create($request->all());

        // return response()->json($comment);

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }
}