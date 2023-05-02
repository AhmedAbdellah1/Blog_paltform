<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{


    // this function is for showing the posts
    public function index()
    {
        return view('posts', [

            // this is for showing the posts filtered by search and category and author
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(5, ['*'], 'page', 1),

            // for get category
            'categories' => Category::all(),

            // giv me tha category matches slug and request('category')
            'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);
    }

    // this function is for showing the post by id
    public function show(Post $post)
    {
        return view('post', ['post' => $post]);
    }
}
