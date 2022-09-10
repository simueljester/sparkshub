<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
     protected $table = 'notifications';

    protected $fillable = [ 
        'notifiable_id',
        'notified_by',
        'description',
        'url',
        'read_at'
    ];

    public function notifiable(){
        return $this->belongsTo('App\User', 'notifiable_id', 'id');
    }

    public function notifiedBy(){
        return $this->belongsTo('App\User', 'notified_by', 'id');
    }
}
