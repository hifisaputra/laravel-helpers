<?php

namespace Fei77\LaravelHelpers;
use Image;
use File;
use Storage;
use Fei77\LaravelHelpers\Helpers\ImageHelpers;
use Fei77\LaravelHelpers\Helpers\PixabayHelpers;

class LaravelHelpers
{
  public function image($image)
  {
    return new ImageHelpers($image);
  }

  public function pixabay()
  {
    return new PixabayHelpers();
  }

  public function delete($arrayPath=[])
  {
    foreach ($arrayPath as $path) {
      if ($path != '') {
        unlink(storage_path('app/public/'.$path));
      }
    }

  }
}
