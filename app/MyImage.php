<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class MyImage
{
    public function saveImage(UploadedFile $photo)
    {
        $fileName = date('ymdHi').'.'.$photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';  
        $photo->move($destinationPath, $fileName);
        return $fileName;
    }

    public function deleteImage($filename)
    {
        $path = public_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';        
        $path = $path . DIRECTORY_SEPARATOR . $filename;
        return File::delete($path);
    }
}