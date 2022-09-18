<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = [ 
        'title',
        'description',
        'user_id',
        'subject_id',
        'downloadable',
        'approved_at',
        'approver',
        'archived_at'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }

    public function files(): HasMany {
        return $this->hasMany('App\ModuleFile', 'module_id','id');
    }

    public function approverAccount(){
        return $this->belongsTo('App\User', 'approver', 'id');
    }
}
