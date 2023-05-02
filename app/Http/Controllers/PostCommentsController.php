<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    // write a function  store comments
    public function store(Post $post)
    {

        // validate the request
        request()->validate([
            'body' => 'required'
        ]);

        // create a comment
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        // redirect to the post
        return back();
    }
}
