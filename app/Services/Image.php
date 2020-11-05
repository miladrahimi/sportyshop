<?php

namespace App\Services;

class Image
{
    /**
     * @var resource
     */
    var $image;

    /**
     * @var string
     */
    var $type;

    /**
     * @param string $filename
     */
    public function load(string $filename)
    {
        $this->type = getimagesize($filename)[2];

        if ($this->type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    /**
     * @param string $filename
     * @param int $type
     * @param int $compression
     * @param int|null $permissions
     */
    public function save(string $filename, int $type = IMAGETYPE_JPEG, int $compression = 75, int $permissions = null)
    {
        if ($type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }

        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    public function output($type = IMAGETYPE_JPEG)
    {
        if ($type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($type == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($type == IMAGETYPE_PNG) {
            imagepng($this->image);
        }
    }

    public function getWidth()
    {
        return imagesx($this->image);
    }

    public function getHeight()
    {
        return imagesy($this->image);
    }

    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    public function resize($width, $height)
    {
        $new = imagecreatetruecolor($width, $height);

        imagecopyresampled(
            $new,
            $this->image,
            0,
            0,
            0,
            0,
            $width,
            $height,
            $this->getWidth(),
            $this->getHeight()
        );

        $this->image = $new;
    }
}
