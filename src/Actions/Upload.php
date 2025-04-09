<?php

namespace Rp76\LaravelPack\Actions;

use Illuminate\Http\UploadedFile;

class Upload
{
    public function handel(?UploadedFile $file, string $path = "uploads/"): ?string
    {
        if (!$file)
            return null;

        $imageName = uniqid() . "." . $file->getClientOriginalExtension();
        $file->move(public_path($path), $imageName);

        return $path . $imageName;
    }
}