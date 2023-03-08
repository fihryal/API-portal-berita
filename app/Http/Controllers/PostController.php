<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResourc;
use Illuminate\Http\Request;
use App\Models\post;
use App\Http\Resources;
use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    public function index(){
        $post = Post :: all();
        // return response()->json(["data" => $post]);
        return PostResourc::collection($post);
    }
}