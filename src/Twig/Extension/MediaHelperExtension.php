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
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('media_url', [MediaHelperRuntime::class, 'generateMediaUrl']),
        ];
    }
}
