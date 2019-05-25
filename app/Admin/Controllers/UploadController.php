<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Honviettour\Traits\CommonTrait;
use Image;

class UploadController extends Controller
{
    use CommonTrait;
    public function handleImage(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $file = $request->file('image');
                return $this->saveImages($file->getPathName());
                break;
            case 'DELETE':
                return $this->deleteImages($request->get('image'));
                break;
            default:
                break;
        }
    }

    public function saveImages($tempPath)
    {
        $editorImgStoragePath = 'storage/images/editor/';
        $path = public_path($editorImgStoragePath);
        $photoName = $this->getRandomString() . config('constants.img_default_extension');
        $savedPhotoPath = $path . $photoName;
        $this->checkAndCreateDir($path);
        $img = Image::make($tempPath);
        $img->resize(config('constants.img_max_width'), null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($savedPhotoPath, config('constants.jpeg_quality'));
        return url($editorImgStoragePath . $photoName);
    }

    public function deleteImages($image)
    {
        $imagePath = str_replace(url(''), public_path(), $image);
        if(is_file($imagePath)) {
            return unlink($imagePath) ? 'OK' : 'Can not remove image';
        }
        return 'Image not found';
    }
}