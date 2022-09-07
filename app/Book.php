<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Book extends Model
{
    //
    protected $table = 'books';

    protected $fillable = [ 
        'isbn',
        'title',
        'category',
        'publication_date',
        'copies',
        'cover',
        'archived_at'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
