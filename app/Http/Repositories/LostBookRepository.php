<?php
namespace App\Http\Repositories;

use App\LostBook;
use Carbon\Carbon;
use App\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class LostBookRepository extends BaseRepository 
{
    function __construct(LostBook $model)
    {
        $this->model = $model;
    }
}