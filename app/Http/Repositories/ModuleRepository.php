<?php
namespace App\Http\Repositories;

use App\Module;
use App\Subject;
use Carbon\Carbon;
use App\BookCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ModuleRepository extends BaseRepository 
{
    function __construct(Module $model){
        $this->model = $model;
    }

    public function archive($module_id){
        $module = Module::find($module_id);
        $module->archived_at = now();
        $module->save();
    }

    public function archiveRemove($module_id){
        $book = Module::find($module_id);
        $book->archived_at = null;
        $book->save();
    }
}