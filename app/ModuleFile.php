<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleFile extends Model
{
    protected $table = 'module_files';

    protected $fillable = [ 
        'module_id',
        'file'
    ];

    public function module(): BelongsTo{
        return $this->belongsTo(Module::class);
    }
}
