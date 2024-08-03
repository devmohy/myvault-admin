<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait Upload
{
    public function UploadFile(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $fileName = !is_null($filename) ? $filename : Str::random(10);
        return $file->storeAs(
            $folder,
            $fileName . "." . $file->getClientOriginalExtension(),
            's3'
        );
    }

    public function deleteFile($path, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}