<?php
namespace App\Http\Repositories;

use Carbon\Carbon;
use App\BookCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class BookCategoryRepository extends BaseRepository 
{
    function __construct(BookCategory $model)
    {
        $this->model = $model;
    }
}