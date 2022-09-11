<?php
namespace App\Http\Repositories;

use App\Module;
use App\Subject;
use Carbon\Carbon;
use App\ModuleFile;
use App\BookCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ModuleFileRepository extends BaseRepository 
{
    function __construct(ModuleFile $model)
    {
        $this->model = $model;
    }
}