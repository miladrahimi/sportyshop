<?php

namespace App\Services;

class FileManager
{
    public function store(string $tempPath, string $newPath, string $name): string
    {
        $base = "files/$newPath";
        $this->makeIfNotExist($base);

        $file = "$base/$name";
        $path = public_path($file);

        rename($tempPath, $path);

        return $file;
    }

    public function delete($path)
    {
        $path = public_path("files/$path");
        file_exists($path) && unlink($path);
    }

    public function files(string $dir): array
    {
        $base = "files/$dir";
        $path = public_path($base);
        $url = asset($base);

        $this->makeIfNotExist($path);

        return array_map(function ($file) use ($url) {
            return "$url/$file";
        }, array_values(array_diff(scandir($path), ['.', '..'])));
    }

    public function exists(string $path): bool
    {
        return file_exists("files/$path");
    }

    private function makeIfNotExist(string $path)
    {
        if (file_exists($path) == false) {
            $oldMask = umask(0);
            mkdir($path, 0777, true);
            umask($oldMask);
        }
    }
}
