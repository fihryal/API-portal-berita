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
        // return PostResourc::collection($posts);
        // return PostResourc::collection($posts->loadMissing('writer:id,username'));
        return DetailPostResourc::collection($posts->loadMissing('writer:id,username', 'comments:id,post_id,user_id,comments_content'));
    }

    public function show($id){
        $post = Post::with('writer:id,username', 'comments:id,post_id,user_id,comments_content')->findOrFail($id);
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

    public function update(Request $request, $id){
        $request-> validate([
            'title' => 'required|max:225',
            'news_content' => 'required'
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        // return response()->json('sudah dapat di gunakan');
        return new DetailPostResourc($post->loadMissing('writer:id,username'));
    }

    public function delete($id){
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Data berhasil di hapus'
        ]);
    }
}