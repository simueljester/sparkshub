<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [ 
        'name'
    ];

    public function modules(): HasMany {
        return $this->hasMany('App\Module', 'subject_id','id');
    }
}
