<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostBook extends Model
{
    protected $table = 'lost_books';

    protected $fillable = [ 
        'book_id',
        'requested_book_id',
        'user_id',
        'subject',
        'description',
        'file',
        'approved_at',
        'approver',
        'date_of_incident'
    ];

    protected $dates = ['date_of_incident','approved_at'];

    public function book(){
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    public function requestedBook(){
        return $this->belongsTo('App\RequestedBook', 'requested_book_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function approverAccount(){
        return $this->belongsTo('App\User', 'approver', 'id');
    }
}
