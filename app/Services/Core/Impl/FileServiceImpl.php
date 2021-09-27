<?php

namespace App\Services\Core\Impl;

use App\Services\Core\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileServiceImpl implements FileService
{

    public function store(UploadedFile $image, string $path): string
    {
        $image_path = time() . ((string)Str::uuid()) . 'files.' . $image->getClientOriginalExtension();
        return $image->move($path, $image_path);
    }

    public function remove(string $path)
    {
        if (file_exists($path)) {
            return unlink($path);
        }
        return false;
    }

    public function updateWithRemoveOrStore(UploadedFile $image, string $path, string $oldFilePath = null): string
    {
        if ($oldFilePath) {
            $this->remove($oldFilePath);
        }
        return $this->store($image, $path);
    }
}
