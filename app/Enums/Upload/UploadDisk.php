<?php

namespace App\Enums\Upload;

enum UploadDisk: string
{
    case Local = 'local';
    case PublicDir = 'public';
    case S3 = 's3';
}
