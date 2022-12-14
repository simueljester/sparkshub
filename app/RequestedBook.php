<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RequestedBook extends Model
{
    //
    protected $table = 'requested_books';

    protected $fillable = [ 
        'book_id',
        'user_id',
        'message',
        'start_date',
        'end_date',
        'approved_at',
        'approver',
        'returned_at',
        'duration',
        'lost_at'
    ];

    protected $dates = ['start_date','end_date','approved_at','returned_at','lost_at'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function approverAccount(){
        return $this->belongsTo('App\User', 'approver', 'id');
    }

    public function book(){
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    public function filedReport(): HasOne {
        return $this->hasOne('App\LostBook', 'requested_book_id','id');
    }
}
