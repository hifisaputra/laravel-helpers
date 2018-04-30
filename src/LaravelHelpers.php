<?php

namespace Fei77\LaravelHelpers;
use Image;
use File;
use Storage;
use Fei77\LaravelHelpers\Helpers\ImageHelpers;
use Fei77\LaravelHelpers\Helpers\PixabayHelpers;
use Fei77\LaravelHelpers\Helpers\ConfigHelpers;

class LaravelHelpers
{
    /**
     * Return image helpers
     * 
     * @param Image
     */
    public function image($image)
    {
        return new ImageHelpers($image);
    }

    /**
     * Delete file from storage
     * 
     * @param array
     */
    public function delete($arrayPath=[])
    {
        foreach ($arrayPath as $path) {
            if ($path != '') {
                !starts_with($path, '/') ? $path = '/'.$path : $path = $path ;
                if (file_exists($this->path.$path)) {
                unlink($this->path.$path);
                }
            }
        }

    }

    /**
     * Return config helpers
     * 
     */
    public function config()
    {
        return new ConfigHelpers;
    }
}
