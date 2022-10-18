<?php

namespace App\Enums\Image;

enum ImageMimetype: string
{
    case PNG = 'image/png';
    case JPG = 'image/jpeg';
    case GIF = 'image/gif';
    case BMP = 'image/bmp';
}
