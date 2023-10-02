<?php

namespace App\Helpers;

class Image
{
    public static function upload($file, $path)
    {
        $name = '';
        if ($file) {
            $image = $file;
            $imageName = time() . $image->hashName();
            $file->move(public_path('images/'.$path), $imageName);
            $name = 'images/'.$path.'/' . $imageName;
        }
        return $name;
    }
}