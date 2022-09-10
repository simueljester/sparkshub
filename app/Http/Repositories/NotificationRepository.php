<?php
namespace App\Http\Repositories;

use Carbon\Carbon;
use App\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class NotificationRepository extends BaseRepository 
{
    function __construct(Notification $model)
    {
        $this->model = $model;
    }
}