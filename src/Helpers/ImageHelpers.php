<?php

namespace Fei77\LaravelHelpers\Helpers;
use Image;
use File;

class ImageHelpers
{
    /**
     * The image file
     */
    protected $image;

    /**
     * Path where to save the file
     * 
     * @var string
     */
    protected $path;

    /**
     * Prefix for filename
     * 
     * @var string
     */
    protected $prefix;

    /**
     * Default image encode
     * 
     * @var string
     */
    protected $encode = 'jpg';

    /**
     * Default folder to save the file
     * 
     * @var string
     */
    protected $folder = '/images/';

    /**
     * The image's filename.
     * 
     * @var string
     */
    protected $name;

    public function __construct($image)
    {
        $this->path = public_path();
        $this->image = Image::make($image);
        return $this;
    }

    /**
     * Set default path for saving the file
     * 
     * @param string $path
     */
    public function path($path)
    {
        File::makeDirectory($path, 0775, true, true);
        $this->path = $path;
        return $this;
    }

    /**
     * Set default folder for saving the file
     * 
     * @param string $folder
     */
    public function folder($folder)
    {
        File::makeDirectory($this->path.str_finish(str_start($folder, '/'), '/'), 0775, true, true);
        $this->folder = $folder;
        return $this;
    }

    /**
     * Set image encoding
     * 
     * @param string $encode
     * @param int $compression_level
     */
    public function encode($encode='jpg', $compression_level=95)
    {
        $this->image->encode($encode, $compression_level);
        $this->encode = $encode;
        return $this;
    }

    /**
     * Set prefix for image's filename
     * 
     * @param string $prefix
     */
    public function prefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Manually set the image's filename.
     * 
     * @param string $name
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Generate a name for the image.
     * 
     * @return string
     */
    public function getName()
    {
        $name = '';

        if($this->prefix) $name .= "$this->prefix - ";

        if($this->name) {
            $name .= $this->name;
        } else {
            $name .= uniqid().'.'.$this->encode;
        }

        return $name;
    }

    /**
     * Save image to storage
     * 
     * @param int $width
     * @param int $height
     * @return string
     */
    public function save($width = null, $height = null)
    {
        $name = $this->getName();

        if($width !== null || $height !== null) {
            $this->resizer($this->image, ['width' => $width, 'height' => $height])->save($this->path.$this->folder.$name);            
        } else {
            $this->image->save($this->path.$this->folder.$name);
        }

        return $this->folder.$name;
    }
    
    /**
     * Resize image
     * 
     * @param 
     */
    public function resizer($image, $size = ['width' => null, 'height' => null])
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
