<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='books';
    protected $fillable = [
    'book_name',
    'synopsis',
    'author_id',
    'published',
    'status',
    'genre_id',
    'cover_image',
    'cover_image_url',
];
public function author()
    {
        return $this->belongsTo(Author::class);
    }
public function genre()
{
    return $this->belongsTo(Genre::class);
}
public function chapters()
{
    return $this->hasMany(Chapter::class)->orderBy('chapter_number');
}


}
