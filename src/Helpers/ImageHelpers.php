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
  protected $folder = 'images/';

  public function __construct($image)
  {
    $this->path = public_path();
    $this->image = Image::make($image);
    return $this;
  }

  public function path($path)
  {
    File::makeDirectory($path, 0775, true, true);
    $this->path = $path;

    return $this;
  }

  public function folder($folder)
  {
    File::makeDirectory($this->path.$folder, 0775, true, true);
    $this->folder = $folder;

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
    $this->image->save($this->path.$this->folder.$name);
    return $this->folder.$name;
  }

  public function saveWithThumbnail()
  {
    $name = $this->prefix.uniqid().'.'.$this->encode;
    $thumb = $this->prefix.uniqid().'_tn.'.$this->encode;
    $this->image->save($this->path.$this->folder.$name);

    Image::make($this->image->resize(null, 200, function ($constraint) {
        $constraint->aspectRatio();
    })->save($this->path.$this->folder.$thumb));

    return [
      'originalName' => $this->folder.$name,
      'thumbnailName' => $this->folder.$thumb
    ];
  }

}
