<?php

namespace App;

use Illuminate\Filesystem\FilesystemManager;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Intervention\Image\ImageManager;
use League\Glide\Manipulators\{
    Orientation,
    Crop,
    Size,
    Brightness,
    Contrast,
    Gamma,
    Sharpen,
    Filter,
    Blur,
    Pixelate,
    Watermark,
    Background,
    Border,
    Encode
};
use League\Glide\Api\Api;
use League\Glide\Server;
use League\Glide\Signatures\SignatureFactory;
use League\Glide\Signatures\SignatureException;

// Returns an image from a particular disk & path
class MediaResponseHandler {

    /**
     * Configuration data
     *
     * @var array
     */
    private array $config = [];
    private string $base;

    function __construct(string $base)
    {
        $this->base = $base;
        $this->config = $this->loadConfig();
        dd($this->config);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function handle()
    {

        if(!$this->config('enabled') || !$this->config('standalone')) {
            exit;
        }

        $path = $_GET['path'];
        $properties = $_GET;

        $this->signature($path, $properties);

        $mime = mime_content_type($this->base . '/storage/app/public' . $path);

        if(!in_array($mime, $this->config('mime_types'))) {
            if(in_array($mime, $this->config('mime_types_bypass'))) {
                header('Content-type: ' . $mime);
                readfile($this->base . '/storage/app/public' . $path);
            }
            exit;
        }

        $server = $this->server($this->base);

        // Set response factory
        $server->setResponseFactory(new SymfonyResponseFactory());

        $server->outputImage($path, $properties);


    }

    private function server()
    {
        $source = new Filesystem(
            new LocalFilesystemAdapter($this->base . '/storage/app/public')
        );

        // Set cache filesystem
        $cache = new Filesystem(
            new LocalFilesystemAdapter($this->base . '/storage/framework/cache/glide')
        );

        // Set watermarks filesystem
        // $watermarks = new Filesystem(
        //     new LocalFilesystemAdapter('/app/storage/app/watermarks')
        // );

        // Set image manager
        $imageManager = new ImageManager([
            'driver' => 'gd',
        ]);

        // Set manipulators
        $manipulators = [
            new Orientation(),
            new Crop(),
            new Size($this->config('max_image_size')),
            new Brightness(),
            new Contrast(),
            new Gamma(),
            new Sharpen(),
            new Filter(),
            new Blur(),
            new Pixelate(),
            // new Watermark($watermarks),
            new Background(),
            new Border(),
            new Encode(),
        ];

        // Set API
        $api = new Api($imageManager, $manipulators);

        // Setup Glide server
        return new Server(
            $source,
            $cache,
            $api,
        );

    }


    private function signature($path, $properties): void
    {
        try {
            // Set complicated sign key
            $signkey = $this->config('key');

            unset($properties['path']);

            // Validate HTTP signature
            SignatureFactory::create($signkey)->validateRequest($this->config('route') . $path, $properties);

        } catch (SignatureException $e) {
            // Handle error
            throw $e;
        }


    }




    /**
     * Manually load Laravel configuration data
     *
     * @return array
     */
    private function config(string $path): mixed
    {
        $arr = explode('.', $path);

        $values = $this->config['glide'];

        $return = null;

        foreach($arr as $a) {
            if(isset($values[$a])) {
                $return = $values[$a];
                $values = $values[$a];
            } else {
                $return = null;
            }
        }

        return $return;
    }

    /**
     * Manually load Laravel configuration data
     *
     * @return array
     */
    private function loadConfig(): array
    {
        // Load root config
        if(file_exists($this->base . '/config/glide.php')) {
            $config = require $this->base . '/config/glide.php';
        } else {
            $config = [];
        }

        return $config;
    }

}








// Set source filesystem




// $source = new Filesystem(
//     new LocalFilesystemAdapter('/app/storage/app/public')
// );

// // Set cache filesystem
// $cache = new Filesystem(
//     new LocalFilesystemAdapter('/app/storage/framework/cache/glide')
// );

// // Set watermarks filesystem
// $watermarks = new Filesystem(
//     new LocalFilesystemAdapter('path/to/watermarks/folder')
// );

// // Set image manager
// $imageManager = new Intervention\Image\ImageManager([
//     'driver' => 'gd',
// ]);

// // Set manipulators
// $manipulators = [
//     new League\Glide\Manipulators\Orientation(),
//     new League\Glide\Manipulators\Crop(),
//     new League\Glide\Manipulators\Size(2000*2000),
//     new League\Glide\Manipulators\Brightness(),
//     new League\Glide\Manipulators\Contrast(),
//     new League\Glide\Manipulators\Gamma(),
//     new League\Glide\Manipulators\Sharpen(),
//     new League\Glide\Manipulators\Filter(),
//     new League\Glide\Manipulators\Blur(),
//     new League\Glide\Manipulators\Pixelate(),
//     new League\Glide\Manipulators\Watermark($watermarks),
//     new League\Glide\Manipulators\Background(),
//     new League\Glide\Manipulators\Border(),
//     new League\Glide\Manipulators\Encode(),
// ];

// // Set API
// $api = new League\Glide\Api\Api($imageManager, $manipulators);

// // Setup Glide server
// $server = new League\Glide\Server(
//     $source,
//     $cache,
//     $api,
// );

// // Set response factory
// $server->setResponseFactory(new SymfonyResponseFactory());

// $server->outputImage($_GET['path'], $_GET);






// // Get the image filestorage
// if ($request()->input('resource')) {
//     // Image is located in resources folder, so build a temp storage class
//     $filesystem = Storage::build([
//         'driver' => 'local',
//         'root' => resource_path(''),
//         'url' => env('APP_URL'),
//         'visibility' => 'public',
//     ]);
// } elseif ($request->input('public')) {
//     // Image is located in public folder, so build a temp storage class
//     $filesystem = Storage::build([
//         'driver' => 'local',
//         'root' => public_path(''),
//         'url' => env('APP_URL'),
//         'visibility' => 'public',
//     ]);
// } else {
//     $disk = $request->input('disk') ?? $config->get('base.glide.disk');
//     $filesystem = Storage::disk($disk);
// }

// if ($filesystem->exists($path)) {
//     // Check if it's a supported image type first
//     if (in_array($filesystem->mimeType($path), $config->get('base.glide.mime_types'))) {
//         // It's supported by the processor
//         $server = $imageservice->createServer($request, $filesystem->path(''));
//         header('Glide:Supported');
//         if ($server->cacheFileExists($path, request()->all())) {
//             header('GlideCache:Hit');
//         } else {
//             header('GlideCache:Miss');
//         }

//         return $server->getImageResponse($path, request()->all());
//     }
//     // It's not supported - so just return the file
//     header('Glide:Unsupported');
//     if ($filesystem->mimeType($path) == 'image/svg') {
//         // Set the correct content type for SVG's
//         $headers = ['Content-Type' => 'image/svg+xml'];
//     } else {
//         $headers = [];
//     }

//     return response()->file($filesystem->path($path), $headers);
// }





