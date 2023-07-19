<?php

namespace Backend\Libraries;

use Backend\Services\DummyImage\GenerateImage;

class Images
{
    public function create($text = 'TestImage'): void
    {
        $image = (new GenerateImage($text))->send();
    }
}
