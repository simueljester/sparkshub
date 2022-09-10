<?php
namespace App\Http\Repositories;

use App\User;
use Carbon\Carbon;
use App\RequestedBook;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class RequestedBookRepository extends BaseRepository 
{
    function __construct(RequestedBook $model)
    {
        $this->model = $model;
    }

}