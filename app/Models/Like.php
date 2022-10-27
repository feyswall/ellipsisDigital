<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id'];

    /**
     * Get the user that owns the Like
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the comment that owns the Like
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }


    /**
     * Get the book that owns the Like
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
}
