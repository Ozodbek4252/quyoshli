<?php

namespace App\Api;

use Carbon\Carbon;
use Intervention\Image\Facades\Image as Imagee;

class ImageResize
{
    /**
     * @param string $type
     * @return string
     */
    private function mkdir(string $type)
    {
        $folder = Carbon::now()->format('Y/m/d');
        $path = "uploads/{$type}/thumbs/{$folder}";

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        return $path;
    }

    /**
     * @param $path
     * @param $size
     * @param $type
     * @return string
     */
    public function resize($path, $size, $type)
    {
        $name = basename($path);
        $folder = $this->mkdir($type);
        $path_thumb = "{$folder}/{$name}";

        $img = Imagee::make(public_path($path));
        $img->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(public_path() .  "/{$path_thumb}", 100);

        return $path_thumb;
    }
}
