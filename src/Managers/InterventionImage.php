<?php

namespace Flint\Managers;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

class InterventionImage
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager();
    }

    public function make($path)
    {
        return $this->manager->make($path);
    }
}
