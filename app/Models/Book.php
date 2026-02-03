<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
    'book_name',
    'author_name',
    'published',
    'status',
    'genre_id',
];
public function genre()
{
    return $this->belongsTo(Genre::class);
}

}
