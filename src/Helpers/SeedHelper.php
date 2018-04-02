<?php

namespace Fei77\LaravelHelpers\Helpers;
use Faker\Factory;

class SeedHelper
{
  protected $faker;
  
  public function __construct()
  {
    $this->faker = Factory::create();
  }

}
