<?php

namespace App\Http\Controllers;

use App\Models\Rss;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $title = '';

        if (request('source')) {
            $source = Rss::firstWhere('username', request('source'));
            $title = ' by ' . $source->name;
        }

        return view('posts', [
            "title" => "All Posts" . $title,
            "active" => 'posts',
            "posts" => Post::latest()->filter(request(['search', 'source']))->paginate(10)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            "title" => "Single Post",
            "active" => 'posts',
            "post" => $post
        ]);
    }

    public function getPost(){
        // get from news
        // $news= Post::where('rss_id', $rss_id)->get();
        // return response()->json($news, 200);
        $posts = Post::all();
        return response()->json($posts);
    }
    
}

