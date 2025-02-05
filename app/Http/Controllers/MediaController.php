<?php namespace App\Http\Controllers;

use App\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MediaGetRequest;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public function admin(Request $request, string $disk, string $path)
    {
        $headers = [
            'Access-Control-Allow-Origin' => config('app.url_admin')
        ];
        $filesystem = Storage::disk($disk);
        return response()->file($filesystem->path($path), $headers);
    }

    // Returns an image from a particular disk & path
    public function handle(MediaGetRequest $request, string $path)
    {
        if(!config('glide.enabled')) {
            abort('403');
        }

        $disk = $request->input('disk') ?? config('glide.disk');
        $filesystem = Storage::disk($disk);

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
