<?php

namespace App\Services;

class FilesServices 
{
    public function uploadFile($file, $path)
    {
        $image_name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('files/' . $path), $image_name);
        return $image_name;
    }
}
