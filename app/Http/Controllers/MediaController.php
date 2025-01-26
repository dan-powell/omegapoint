<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MediaGetRequest;

class ImageController extends Controller
{

    // Returns an image from a particular disk & path
    public function handle(MediaGetRequest $request, string $path)
    {

        // Get the image filestorage
        if($request->input('public')) {
            // Image is located in public folder, so build a temp storage class
            $filesystem = Storage::build([
                'driver' => 'local',
                'root' => public_path(''),
                'url' => env('APP_URL'),
                'visibility' => 'public',
            ]);
        } else {
            //
            $disk = $request->input('disk') ?? config('glide.disk');
            $filesystem = Storage::disk($disk);
        }


        if ($filesystem->exists($path)) {
            // Check if it's a supported image type first
            if (in_array($filesystem->mimeType($path), config('glide.mime_types'))) {
                // It's supported by the processor
                $server = Image::createServer($request, $filesystem->path(''));
                header('Glide:Supported');
                if($server->cacheFileExists($path, request()->all())) {
                    header('GlideCache:Hit');
                } else {
                    header('GlideCache:Miss');
                }
                return $server->getImageResponse($path, request()->all());
            }
            // It's not supported - so just return the file
            header('Glide:Unsupported');
            if ($filesystem->mimeType($path) == 'image/svg') {
                // Set the correct content type for SVG's
                $headers = ['Content-Type' => 'image/svg+xml'];
            } else {
                $headers = [];
            }

            return response()->file($filesystem->path($path), $headers);
        }
        abort('404');
    }
}
