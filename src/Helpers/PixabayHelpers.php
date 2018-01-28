<?php

namespace Fei77\LaravelHelpers\Helpers;
use Image;
use File;

class PixabayHelpers
{
  protected $options = [
    'key' => config('laravel-helpers.apis.pixabay')
  ];

  public function options($options)
  {
    foreach ($options as $key => $value) {
      array_set($this->options, $key, $value);
    }

    return $this;
  }

  public function search($q=null)
  {
    if ($q != null) {
      array_set($this->options, 'q', $q)
    }
  }
}
