<?php

namespace App\Services\Core;

use Illuminate\Http\UploadedFile;

interface FileService
{
    public function store(UploadedFile $image, string $path): string;

    public function remove(string $path);

    public function updateWithRemoveOrStore(UploadedFile $image, string $path, string $oldFilePath = null): string;

}
