<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\MediaHelperRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MediaHelperExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('media_url', [MediaHelperRuntime::class, 'generateMediaUrl']),
            new TwigFilter('media_capture_path', [MediaHelperRuntime::class, 'generateMediaCapturePath']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('media_url', [MediaHelperRuntime::class, 'generateMediaUrl']),
            new TwigFunction('media_capture_path', [MediaHelperRuntime::class, 'generateMediaCapturePath']),
        ];
    }
}
