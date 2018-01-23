<?php

namespace Fei77\LaravelHelpers;
use Image;
use File;
use Storage;

class LaravelHelpers
{
  public function saveImage($image, $path, $prefix='', $encode='jpg')
  {
    $image = Image::make($image)->encode($encode, 80);

    $name = $prefix.uniqid().'.'.$encode;

    $storage_path = storage_path('app/public/'.$path);

    File::makeDirectory($storage_path, 0775, true, true);

    $image->save($storage_path.$name);
    Image::make($image->resize(null, 200, function ($constraint) {
        $constraint->aspectRatio();
    })->save($storage_path.$thumbnail));

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
