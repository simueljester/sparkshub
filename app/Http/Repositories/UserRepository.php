<?php
namespace App\Http\Repositories;

use Carbon\Carbon;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class UserRepository extends BaseRepository 
{
    function __construct(User $model)
    {
        $this->model = $model;
    }

    public function archive($user_id){
        $book = User::find($user_id);
        $book->archived_at = now();
        $book->save();
    }
    public function archiveRemove($user_id){
        $book = User::find($user_id);
        $book->archived_at = null;
        $book->save();
    }
}