<?php
namespace App\Http\Repositories;

use App\User;
use App\UserLog;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class UserLogRepository extends BaseRepository 
{
    function __construct(UserLog $model)
    {
        $this->model = $model;
    }

}