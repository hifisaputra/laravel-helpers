# LaravelHelpers

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require fei77/laravel-helpers dev-master
```

## Usage

``` php
// Image helpers
$image = Helpers::image($request->imagefile)

/**
 * Change directory path using laravel's helper functions
 *
 * Parameters:
 * (string) - default (public_path())
 *
 */
$image->path(storage_path())

/**
 * Change the folder path
 *
 * Parameters:
 * (string) - default ('images')
 */
$image->folder('images/profile')  

/**
 * Add prefix to filename
 *
 * Parameters:
 * (string) Here's a list of encoding format
 * supported by [Intervention Image](http://image.intervention.io)
 *
 *  jpg — return JPEG encoded image data
 *  png — return Portable Network Graphics (PNG) encoded image data
 *  gif — return Graphics Interchange Format (GIF) encoded image data
 *  tif — return Tagged Image File Format (TIFF) encoded image data
 *  bmp — return Bitmap (BMP) encoded image data
 *  ico — return ICO encoded image data
 *  psd — return Photoshop Document (PSD) encoded image data
 *  webp — return WebP encoded image data
 *  data-url — encode current image data in data URI scheme (RFC 2397)
 *
 * (integer) Define the quality of the encoded image optionally.
 * Data ranging from 0 (poor quality, small file) to 100 (best quality, big file).
 */
$image->encode('jpg', 95)

/**
 * Add prefix to filename
 *
 * Parameters:
 * (string)
 */
$image->prefix('user-')

/**
 * Save the image
 * Return the image's name
 */
$image->save();

dd($image) // '/images/profile/user-5a9d24bb389ae.jpg'


/**
 * Save the image with thumbnail
 * Return an array of the image's name and the thumbnail's name
 */
$image->saveWithThumbnail();

dd($image)
/**
 * [
 *	'originalName' : '/images/profile/user-5a9d24bb389ae.jpg',
 *  'thumbnailName' : '/images/profile/user-5a9d24bb389ae_tn.jpg'
 * ]
 */

```

## Example
```php
public function store(Request $request)
{
  $blog = new Blog();
  $blog->user_id = Auth::user()->id;
  if ($request->image) {

    $image = Helpers::image($request->image)->folder('images/blogs')->encode('jpg', 80)->saveWithThumbnail();
	  // the image files will be saved inside public/images/blogs 

    Helpers::delete([$blog->originalUrl, $blog->previewUrl]);

    $blog->originalUrl = $image['originalName'];
    $blog->previewUrl = $image['thumbnailName'];
  }

  $blog->fill($request->translations);
  $blog->save();
}
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.



- [][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/Fei77/LaravelHelpers.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Fei77/LaravelHelpers/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Fei77/LaravelHelpers.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Fei77/LaravelHelpers.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Fei77/LaravelHelpers.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/Fei77/LaravelHelpers
[link-travis]: https://travis-ci.org/Fei77/LaravelHelpers
[link-scrutinizer]: https://scrutinizer-ci.com/g/Fei77/LaravelHelpers/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Fei77/LaravelHelpers
[link-downloads]: https://packagist.org/packages/Fei77/LaravelHelpers
[link-author]: https://github.com/Fei77
[link-contributors]: ../../contributors
