<?php

namespace App\Services;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Urls\UrlBuilderFactory;
use Throwable;

/**
 * Image Helper for generating URL's used by Glide to manipulate images.
 *
 *  Example usage:
 *
 *    Get a URL using default disk
 *    {{ ImageRender::url(<path to image>) }}
 *
 *    Get a URL using specific disk
 *    {{ ImageRender::disk(<disk name>)->url(<path to image>) }}
 *
 *    Get a URL to image directly on cache disk
 *    SLOW PAGE RENDERING - also requires cache disk to be publically available
 *    {{ ImageRender::cache(<path to image>) }}
 *
 *    Crop an image and make greyscale
 *    <img src="{{ ImageRender::crop(200, 300)->greyscale()->url() }}"/>
 *
 *    Use Srcset for optimised & cropped images
 *    (note use of a closure to manipulate each image based on prer-defined width)
 *    <img srcset="{{ ImageRender::srcset($block['data']['image'], fn ($service, $width) => $service->crop($width, floor($width * 1.0))) }}" sizes="50vmin"/>
 */
class ImageService
{
    private $urlBuilder;

    private $properties = [];

    public function __construct(?array $properties = null)
    {
        // Set complicated sign key
        $signkey = config('glide.key');

        // Create instance of URL factory
        $this->urlBuilder = UrlBuilderFactory::create(config('glide.route'), $signkey);
        $this->urlBuilder->setBaseUrl(config('glide.url'));
        // $this->urlBuilder = UrlBuilderFactory::create('imagerender.php', $signkey);

        $this->reset();

        if ($properties) {
            $this->properties = $properties;
        }
    }

    /**
     * Reset parameters / properties
     *
     * @return self
     */
    public function reset(): self
    {
        // Reset all properties
        $this->properties = [];

        // Set the default quality (optional)
        if (config('glide.quality')) {
            $this->quality(config('glide.quality'));
        }

        // Set default format (optional)
        if (config('glide.format')) {
            $this->format(config('glide.format'));
        }

        return $this;
    }

    /**
     * Returns the image server factory used to process images
     *
     * @param Request $request
     * @param string $source
     *
     * @return void
     */
    public function createServer(Request $request, string $source)
    {

        $cache = Storage::disk(config('glide.cache'))->getDriver();
        return ServerFactory::create([
            'driver' => config('glide.driver'),
            'response' => new SymfonyResponseFactory($request),
            'source' => $source,
            'cache' => $cache,
            'cache_path_prefix' => '',
            'cache_with_file_extensions' => true,
            'presets' => config('glide.presets'),
        ]);
    }

    /**
     * Set the image to load from the public folder
     * Overrides any disk option set
     *
     * @param bool $bool
     *
     * @return self
     */
    public function public(bool $bool = true): self
    {
        $this->props_single('public', $bool);

        return $this;
    }

    /**
     * Set the image to load from the resources folder
     * Overrides any disk()/public() option set
     *
     * @param bool $bool
     *
     * @return self
     */
    public function resource(bool $bool = true): self
    {
        $this->props_single('resource', $bool);

        return $this;
    }

    /**
     * Set disk where image is stored
     *
     * @param string|null $disk
     *
     * @return self
     */
    public function disk(string $disk): self
    {
        $this->props_single('disk', $disk);

        return $this;
    }

    // Image Processors

    /**
     * Generate a URL for image processor
     *
     * @param string $path
     *
     * @return string
     */
    public function get(string $path): string
    {
        // Copy properties, and reset them.
        $properties = $this->properties;
        $this->reset();
        return $this->urlBuilder->getUrl($path, $properties); // OG

    }

    /**
     * Get Full URL to processed image
     *
     * @param string $path
     * @param string|null $preset
     *
     * @return string
     */
    public function url(string $path): string
    {
        // Generate a URL
        return $this->get($path);
    }

    /**
     * Get a string of various image sizes to be used within a srcset property
     * Optionally accepts a closure that can be used overide image manipulation
     *
     * @param string $path
     * @param float|null $ratio
     * @param Closure|null $modifiers
     *
     * @return string
     */
    public function srcset(string $path, ?Closure $modifiers = null): string
    {
        $str = '';
        foreach (config('glide.srcset') as $width) {
            $img = (new ImageService($this->properties));
            if ($modifiers) {
                $modifiers($img, $width);
            } else {
                $img->width($width);
            }
            $str .= $img->url($path) . ' ' . $width . 'w,';
        }

        $this->reset();

        return rtrim($str, ',');
    }

    /**
     * Use a pre-defined preset from the config
     *
     * @param string $key
     *
     * @return self
     */
    public function preset(string $key = ''): self
    {
        $this->props_single('p', $key);

        return $this;
    }

    // Image Effects

    /**
     * Rotate image
     *
     * @param string $amount Accepts auto, 0, 90, 180 or 270. Default is auto. The auto option uses Exif data to automatically orient images correctly.
     *
     * @return self
     */
    public function orientation(string $amount = 'auto'): self
    {
        $this->props_single('or', $amount);

        return $this;
    }

    /**
     * Flips the image.
     *
     * @param string $direction Accepts v, h and both.
     *
     * @return self
     */
    public function flip(string $direction = 'h'): self
    {
        $this->props_single('flip', $direction);

        return $this;
    }

    /**
     * Set device pixel ratio
     *
     * @param integer $amount Accepts 1 to 8
     *
     * @return self
     */
    public function dpr(int $amount = 1): self
    {
        $this->props_single('dpr', $amount);

        return $this;
    }

    /**
     * Image quality (for jpg's etc.)
     *
     * @param integer $amount Accepts 0 to 100
     *
     * @return self
     */
    public function quality(int $amount = 90): self
    {
        $this->props_single('q', $amount);

        return $this;
    }

    /**
     * Set the output format
     *
     * @param string $type Accepts jpg, pjpg (progressive jpeg), png, gif, webp or avif. Defaults to webp
     *
     * @return self
     */
    public function format(string $type = 'webp'): self
    {
        $this->props_single('fm', $type);

        return $this;
    }

    /**
     * Set the width (in pixels)
     *
     * @param integer|null $width
     *
     * @return self
     */
    public function width(?int $width = null): self
    {
        $this->props_single('w', $width);

        return $this;
    }

    /**
     * Set the height (in pixels)
     *
     * @param integer|null $height
     *
     * @return self
     */
    public function height(?int $height = null): self
    {
        $this->props_single('h', $height);

        return $this;
    }

    /**
     * Set a max size of the image without cropping
     *
     * @param integer|null $width
     * @param integer|null $height
     * @param string $fit
     *
     * @return self
     */
    public function size(?int $width = null, ?int $height = null, string $fit = 'max'): self
    {
        $this->props_array([
            'w' => $width,
            'h' => $height,
            'fit' => $fit,
        ]);

        return $this;
    }

    /**
     * Crop the image
     *
     * @param integer|null $width
     * @param integer|null $height
     * @param string $fit
     *
     * @return self
     */
    public function crop(?int $width = null, ?int $height = null, string $fit = 'crop'): self
    {
        $this->props_array([
            'w' => $width,
            'h' => $height,
            'fit' => $fit,
        ]);

        return $this;
    }

    /**
     * Crop image to the left
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_left(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-left');

        return $this;
    }

    /**
     * Crop image to the top left
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_top_left(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-top-left');

        return $this;
    }

    /**
     * Crop image to the top
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_top(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-top');

        return $this;
    }

    /**
     * Crop image to the top right
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_top_right(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-top-right');

        return $this;
    }

    /**
     * Crop image to the right
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_right(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-right');

        return $this;
    }

    /**
     * Crop image to the bottom right
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_bottom_right(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-bottom-right');

        return $this;
    }

    /**
     * Crop image to the bottom
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_bottom(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-bottom');

        return $this;
    }

    /**
     * Crop image to the bottom left
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_bottom_left(?int $width = null, ?int $height = null): self
    {
        $this->crop($width, $height, 'crop-bottom-left');

        return $this;
    }

    /**
     * Crop image using a particular focal point
     * Focal point should be specified as percentage of width and height
     *
     * @param integer|null $width
     * @param integer|null $height
     *
     * @return self
     */
    public function crop_focal(?int $width = null, ?int $height = null, string $x = '50', string $y = '50'): self
    {
        $this->crop($width, $height, 'crop-' . $x . '-' . $y);

        return $this;
    }

    /**
     * Blur the image by specified amount
     *
     * @param integer $amount Use values between 0 and 100.
     *
     * @return self
     */
    public function blur(float $amount = 0): self
    {
        $this->props_single('blur', $amount);

        return $this;
    }

    /**
     * Pixelate the image by specified amount
     *
     * @param integer $amount Use values between 0 and 1000.
     *
     * @return self
     */
    public function pixel(float $amount = 0): self
    {
        $this->props_single('pixel', $amount);

        return $this;
    }

    /**
     * Greyscale the image
     *
     * @return self
     */
    public function greyscale(): self
    {
        $this->props_single('filt', 'greyscale');

        return $this;
    }

    /**
     * Sepia-tone the image
     *
     * @return self
     */
    public function sepia(): self
    {
        $this->props_single('filt', 'sepia');

        return $this;
    }

    /**
     * Set image brightness
     *
     * @param integer $amount Use values between -100 and +100, where 0 represents no change
     *
     * @return self
     */
    public function brightness(float $amount = 0): self
    {
        $this->props_single('bri', $amount);

        return $this;
    }

    /**
     * Set the image contrast
     *
     * @param integer $amount Use values between -100 and +100, where 0 represents no change.
     *
     * @return self
     */
    public function contrast(float $amount = 0): self
    {
        $this->props_single('con', $amount);

        return $this;
    }

    /**
     * Set the gamma level
     *
     * @param integer $amount Use values between 0.1 and 9.99.
     *
     * @return self
     */
    public function gamma(float $amount = 5): self
    {
        $this->props_single('gam', $amount);

        return $this;
    }

    /**
     * Sharpen the image
     *
     * @param integer $amount Use values between 0 and 100.
     *
     * @return self
     */
    public function sharpen(float $amount = 0): self
    {
        $this->props_single('sharp', $amount);

        return $this;
    }

    // Private Methods

    /**
     * Add a single manipulation property
     *
     * @param string $property
     * @param [type] $value
     *
     * @return void
     */
    private function props_single(string $property, $value): void
    {
        $this->properties[$property] = $value;
    }

    /**
     * Add multiple manipulation properties
     *
     * @param array $array
     *
     * @return void
     */
    private function props_array(array $array): void
    {
        $this->properties = array_merge($this->properties, $array);
    }

    /**
     * Add multiple manipulation properties
     *
     * @param array $array
     *
     * @return void
     */
    private function cache_disk(array $array): void
    {

    }
}
