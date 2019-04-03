<?php

namespace Honviettour\Traits;
use Encore\Admin\Form;
use Image;

trait CommonTrait
{
    public function getImagesTabField(Form $form, $modelType)
    {
        $form->tabs('images', 'Photo', function(Form\NestedForm $form) use ($modelType){
            $form->image('path', 'Photo');
            $form->switch('status', 'Published');
            $form->hidden('model_type')->default($modelType);
        });
        $form->divide();
    }

    public function saveImages($path, $photoName)
    {
        $savedPhotoPath = $path . $photoName;
        $this->checkAndCreateDir($path);
        $savedPhotoPathThumbnail = $path . 'thumb/' . $photoName;
        $this->checkAndCreateDir($path . 'thumb/');

        $img = Image::make($savedPhotoPath);
        $img->resize(config('constants.img_max_width'), null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($savedPhotoPath, config('constants.jpeg_quality'));

        $img->resize(config('constants.img_thumb_width'), null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($savedPhotoPathThumbnail, config('constants.jpeg_quality'));
        return true;
    }

    public function checkAndCreateDir($path)
    {
        if(is_dir($path)) {
            return true;
        }
        mkdir($path);
        chmod($path, 0775);
        return true;
    }
}
