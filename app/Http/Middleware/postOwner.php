<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class postOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('ini menggunakan middleware');
        
        $currentUser = Auth::user();
        $post = post::findOrFail($request->id);
        
        if ($post -> author != $currentUser->id) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
        
        return $next($request);
    }
}