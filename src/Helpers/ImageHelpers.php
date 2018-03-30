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
  protected $folder = '/images/';

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
    !starts_with($folder, '/') ? $folder = '/'.$folder : $folder = $folder ;
    !ends_with($folder, '/') ? $folder = $folder.'/' : $folder = $folder ;
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

  public function saveWithThumbnail($size = ['width' => null, 'height' => 200])
  {
    $id = uniqid();
    $name = $this->prefix.$id.'.'.$this->encode;
    $thumb = $this->prefix.$id.'_tn.'.$this->encode;
    $this->image->save($this->path.$this->folder.$name);

    $this->resizer($this->image, $size)->save($this->path.$this->folder.$thumb));

    return [
      'originalName' => $this->folder.$name,
      'thumbnailName' => $this->folder.$thumb
    ];
  }

  public function resizer($image, $size = ['height' => null, 'width' => null])
  {
    if ($size['height'] !== null && $size['width'] === null) {
      return Image::make($image->resize($size['height'], null, function($constraint) {
        $constraint->aspectRatio();
      }));
    } elseif ($size['height'] === null && $size['width'] !== null) {
      return Image::make($image->resize(null, $size['width'], function($constraint) {
        $constraint->aspectRatio();
      }));
    } elseif ($size['height'] !== null && $size['width'] !== null) {
      return Image::make($image->resize($size['height'], $size['width']));
    }
  }

}
