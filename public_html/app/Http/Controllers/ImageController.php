<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageController extends Controller
{
    static function uploadImage(UploadedFile $image, $emplId, $fpkId)
    {
        $imageName = self::generateImageName($emplId, $fpkId);
        return $image->storeAs('FpkPhotos', $imageName, 'public');
    }

    private static function generateImageName($emplId, $fpkId)
    {
        return "empl-{$emplId}_fpk-{$fpkId}";
    }
}
