<?php

namespace Fei77\LaravelHelpers\Helpers;
use Image;
use File;

class ImageHelpers
{
  protected $image;
  protected $path;
  protected $prefix;
  protected $encode = 'jpg';
  // protected $compression_level;
  protected $storage_path;

  public function __construct($image)
  {
    $this->storage_path = storage_path('app/public/');
    $this->image = Image::make($image);
    return $this;
  }

  public function path($path)
  {
    File::makeDirectory($storage_path.$path, 0775, true, true);
    $this->path = $path;

    return $this;
  }

  public function encode($encode='jpg', $compression_level=95)
  {
    $this->image->encode($encode, $compression_level);
    $this->encode = $encode;
    return $this;
  }

  public function prefix($prefix)
  {
    $this->prefix = $prefix;
    return $this;
  }

  public function save()
  {
    $name = $this->prefix.uniqid().'.'.$this->encode;
    $this->image->save($this->storage_path.$this->path.$name);
    return $name;
  }

}
