<?php

namespace App\Http\Controllers;

class ImageController extends Controller
{
    /**
     * Generate a thumbnail for a given image
     */
    public function generateThumbnail($image_src, bool $width = false, bool $height = false, int $quality = 90)
    {
        $img = Image::make('public/foo.jpg');

        $img->resize(320, 240);

        $img->insert('public/watermark.png');

        $img->save('public/bar.jpg');
    }
}
