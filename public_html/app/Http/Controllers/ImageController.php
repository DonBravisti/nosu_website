<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageController extends Controller
{
    static function uploadImage(UploadedFile $photo)
    {
        $photo->storeAs('FpkPhotos', '');
    }
}
