<?php

namespace App\Twig\Runtime;

use App\Media\MediaInterface;
use Twig\Extension\RuntimeExtensionInterface;

class MediaHelperRuntime implements RuntimeExtensionInterface
{
    public function generateMediaUrl(MediaInterface $media, string $locale): string
    {
        return $locale === $media->getLocale() ? $media->getUrl() : 'https://translate.google.com/translate?sl=' . $media->getLocale() . '&tl=' . $locale . '&u=' . $media->getUrl();
    }
}