<?php
namespace App\Http\Repositories;

use App\Book;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class BookRepository extends BaseRepository 
{
    function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function archive($book_id){
        $book = Book::find($book_id);
        $book->archived_at = now();
        $book->save();
    }
    public function archiveRemove($book_id){
        $book = Book::find($book_id);
        $book->archived_at = null;
        $book->save();
    }
}