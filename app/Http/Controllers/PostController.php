<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResourc;
use App\Http\Resources\DetailPostResourc;
use Illuminate\Http\Request;
use App\Models\post;
use App\Http\Resources;
use Illuminate\Support\Facades\Auth;


use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    public function index(){
        $posts = Post :: all();
        // return response()->json(["data" => $post]);
        return PostResourc::collection($posts);
    }

    public function show($id){
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new DetailPostResourc($post);
    }
    
    public function show2($id){
        $post = Post::findOrFail($id);
        return new DetailPostResourc($post);
    }

    public function store(Request $request){
        $request-> validate([
            'title' => 'required|max:225',
            'news_content' => 'required'
        ]);

        // return response()->json('sudah dapat di digunakan');
        
        $request['author'] = Auth::user()->id;

        $post = Post::create($request->all());
        return new DetailPostResourc($post->loadMissing('writer:id,username'));
    }
}