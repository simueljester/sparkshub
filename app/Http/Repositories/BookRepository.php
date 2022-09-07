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
}