<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookCategory extends Model
{
    //
    protected $table = 'book_categories';

    protected $fillable = [ 
        'name'
    ];

    public function books(): HasMany {
        return $this->hasMany('App\Book', 'category_id','id');
    }
}
