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
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favouriates()
    {
        return $this->hasMany(Favouriate::class);
    }
}
