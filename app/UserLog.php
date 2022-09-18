<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLog extends Model
{
    protected $table = 'user_logs';

    protected $fillable = [ 
        'user_id',
        'ip_address',
        'user_agent',
        'last_activity'
    ];

    protected $dates = ['last_activity'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
