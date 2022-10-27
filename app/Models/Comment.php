<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'comment'];

    /**
     * Get the user that owns the Comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the book that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get all of the likes for the Comment
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
