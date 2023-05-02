<?php

namespace App\Models;

use Clockwork\Storage\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $with = ['category', 'author'];

    protected $fillable = ['title', 'thumbnail', 'slug', 'excerpt', 'body', 'user_id', 'category_id'];



    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        /*
        * giv me tha post has a category but not any category tha category match slug
        * بقوله هات البوست اللى بينتمى اللى الفئه كذا ولكن مش اى فئه الفئه اللى بتتطابق مع السلق اللى هديهولك
        *
        */
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('name', $author)
            )
        );
    }

    // write a function to return all comments of a post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // writ a function return category for a post
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // write a function return author for a post
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
