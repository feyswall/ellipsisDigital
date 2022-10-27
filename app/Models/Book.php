<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['book_name', 'book_url', 'thumbnail'];

    /**
     * Get all of the favouriates for the Book
     */
    public function favouriates()
    {
        return $this->hasMany(Favouriate::class);
    }

    /**
     * Get all of the comments for the Book
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Get all of the likes for the Book
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
