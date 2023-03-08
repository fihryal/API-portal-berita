<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResourc;
use App\Http\Resources\DetailPostResourc;
use Illuminate\Http\Request;
use App\Models\post;
use App\Http\Resources;
use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    public function index(){
        $posts = Post :: all();
        // return response()->json(["data" => $post]);
        return PostResourc::collection($posts);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return new DetailPostResourc($post);
    }
}