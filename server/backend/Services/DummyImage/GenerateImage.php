<?php

namespace Backend\Services\DummyImage;

use Saloon\Contracts\Request;
use Saloon\Enums\Method;

class GenerateImage extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected $text = 'TestImage', protected $background = '#000', protected $foreground = '#FFF')
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return "https://dummyimage.com/600x400/{$this->background}/{$this->foreground}.png&text={$this->text}";
    }
}
