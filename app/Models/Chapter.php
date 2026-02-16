<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
     protected $fillable = [
        'book_id',
        'chapter_number',
        'chapter_title',
        'content'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    protected static function booted() {
    static::addGlobalScope('ordered', function ($query) {
        $query->orderBy('chapter_number');
    });
    }
}
