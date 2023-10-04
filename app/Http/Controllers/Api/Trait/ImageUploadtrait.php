<?php

namespace App\Http\Controllers\Api\Trait;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
trait ImageUploadTrait
{
   public function upload($file)
    {
        try {

            if ($file) {

                $fileName = time().'.'.$file->getClientOriginalExtension();
                $path='images/';
                $file->move(public_path($path), $fileName);
                $full_path=$path.$fileName;
                    return $full_path; }
            else{
                return null;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteImage($file_name)
    {

        if (File::exists($file_name)) {
            File::delete($file_name);
            return true;
        } else {
            return false;
        }
    }
}
