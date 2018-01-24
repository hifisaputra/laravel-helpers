<?php

namespace Fei77\LaravelHelpers;
use Image;
use File;
use Storage;
use Helpers\ImageHelpers;

class LaravelHelpers
{
  public function image($image)
  {
    return new ImageHelpers($image);  
  }

  public function saveImage($image, $path, $prefix='', $encode='jpg')
  {
    $image = Image::make($image)->encode($encode, 80);

    $name = $prefix.uniqid().'.'.$encode;

    $storage_path = storage_path('app/public/'.$path);

    File::makeDirectory($storage_path, 0775, true, true);

    $image->save($storage_path.$name);

    return $path.$name;
  }

  public function saveThumbnail($image, $path, $prefix='', $encode='jpg')
  {
    $image = Image::make($image)->encode($encode, 80);

    $name = 'thumb-'.$prefix.uniqid().'.'.$encode;

    $storage_path = storage_path('app/public/'.$path);

    File::makeDirectory($storage_path, 0775, true, true);

    Image::make($image->resize(null, 200, function ($constraint) {
        $constraint->aspectRatio();
    })->save($storage_path.$name));

    return $path.$name;
  }
}
