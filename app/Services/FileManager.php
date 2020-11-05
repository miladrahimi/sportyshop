<?php

namespace App\Services;

class FileManager
{
    public function store(string $tempPath, string $type, int $id, string $extension, bool $multiple = true): string
    {
        $wrapper = $this->wrapper($id);
        $path = public_path("files/$type/$wrapper");

        if ($multiple) {
            if (file_exists("$path/$id") == false) {
                mkdir("$path/$id", 0777, true);
            }

            $i = 1;
            do {
                $file = "$path/$id/" . $i++ . ".$extension";
            } while (file_exists($file));
        } else {
            if (file_exists($path) == false) {
                mkdir($path, 0777, true);
            }

            $file = "$path/$id.$extension";
        }

        rename($tempPath, $file);

        return $file;
    }

    public function files(string $type, int $id, bool $multiple = true): array
    {
        $wrapper = $this->wrapper($id);
        $base = $multiple ? "files/$type/$wrapper/$id" : "files/$type/$wrapper";
        $path = public_path($base);
        $url = asset($base);

        return array_map(function ($v) use ($url) {
            return "$url/$v";
        }, array_values(array_diff(scandir($path), array('.', '..'))));
    }

    public function delete(string $type, int $id, string $extension)
    {
        $wrapper = $this->wrapper($id);

        unlink(public_path("files/$type/$wrapper/$id.$extension"));
    }

    private function wrapper(int $id): int
    {
        return $id % 1000;
    }
}
