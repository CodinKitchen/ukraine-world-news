<?php

namespace App\Media;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.media')]
interface MediaInterface
{
    public static function getUrl(): string;

    public static function getLocale(): string;

    public static function getCountry(): string;

    public static function getCustomCss(): string|null;

    public static function getFilename(): string;
}
