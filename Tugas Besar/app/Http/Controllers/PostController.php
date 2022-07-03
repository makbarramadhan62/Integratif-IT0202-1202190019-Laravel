<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Rss;

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
}
