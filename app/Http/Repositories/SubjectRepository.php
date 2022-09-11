<?php
namespace App\Http\Repositories;

use App\Subject;
use Carbon\Carbon;
use App\BookCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class SubjectRepository extends BaseRepository 
{
    function __construct(Subject $model)
    {
        $this->model = $model;
    }
}