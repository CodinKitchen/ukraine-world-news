<?php

namespace App\Twig\Runtime;

use App\Asset\VersionStrategy\FileTimestampVersionStrategy;
use App\Media\MediaInterface;
use Twig\Extension\RuntimeExtensionInterface;

class MediaHelperRuntime implements RuntimeExtensionInterface
{
    public function __construct(private readonly FileTimestampVersionStrategy $fileVersioning)
    {
    }

    public function generateMediaUrl(MediaInterface $media, string $locale): string
    {
        return $locale === $media->getLocale() ? $media->getUrl() : 'https://translate.google.com/translate?sl=' . $media->getLocale() . '&tl=' . $locale . '&u=' . $media->getUrl();
    }

    public function generateMediaCapturePath(MediaInterface $media, string $locale): string
    {
        return \sprintf('/captures/%s/%s/%s.png', $media->getCountry(), $locale, $media->getFilename());
    }

    public function getMediaDate(MediaInterface $media, string $locale): \DateTimeInterface
    {
        return \DateTime::createFromFormat('U', $this->fileVersioning->getVersion($this->generateMediaCapturePath($media, $locale)));
    }
}
