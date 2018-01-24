<?php

namespace Fei77\LaravelHelpers;
use Image;
use File;
use Storage;
use Fei77\LaravelHelpers\Helpers\ImageHelpers;

class LaravelHelpers
{
  public function image($image)
  {
    return new ImageHelpers($image);
  }

  public function delete($arrayPath=[])
  {
    foreach ($arrayPath as $path) {
      if ($path != '') {
        Storage::delete($path);
      }
    }

  }
}
