<?php 
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class UploadHelper {
   
    public static function uploadFile($att)
    {
        $name = 'file-'.time().'.'.$att->getClientOriginalExtension();
        $att->move(public_path('/files'), $name);
        return $name;
    }
}