<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );
    }

    public function upload($filePath, $fileName)
    {
        return $this->imageKit->upload([
            'file' => base64_encode(file_get_contents($filePath)),
            'fileName' => $fileName
        ]);
    }
}
