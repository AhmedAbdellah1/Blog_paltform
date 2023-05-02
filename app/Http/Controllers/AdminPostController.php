<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{

    //write a function to display all posts
    public function index()
    {
        return view('admin.posts.index',  [
            'posts' => Post::paginate(50)
        ]);
    }
    // write a function for the admin to create a post
    public function create()
    {
        return view('admin.posts.create');
    }

    // write a function for the admin to store the post
    public function store()
    {
        $attributes = request()->validate([
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'title' => 'required',
            'thumbnail' => 'required |image',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnail');
        Post::create($attributes);
        return redirect('/');
    }
    // write a function to edit a post
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    // write a function to update a post
    public function update(Post $post)
    {
        $attributes = request()->validate([
            // ignore() is used to ignore the slug if it is the same as the current post
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'title' => 'required',
            'thumbnail' => 'image',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        // if the thumbnail is updated, delete the old one and store the new one
        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnail');
            // delete the old thumbnail
            unlink(public_path($post->thumbnail));
        }
        // update the post
        $post->update($attributes);

        // redirect to the admin panel
        return back()->with('success', 'Post Updated');
    }

    // write a function to delete a post
    public function destroy(Post $post)
    {
        // delete the post
        $post->delete();
        // redirect to the admin panel
        return back()->with('success', 'Post Deleted');
    }
}
