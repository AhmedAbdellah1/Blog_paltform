<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

   

    // write a function that returns the post that this comment belongs to
    // this is a one to many relationship with post model
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // write a function that returns the user that this comment belongs to
    // this is a one to many relationship with user model
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
