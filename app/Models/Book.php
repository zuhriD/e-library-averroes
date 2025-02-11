<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'category_id',
        'price',
        'description',
        'cover',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
