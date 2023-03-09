<?php

namespace App\Media;

class Le20Minutes implements MediaInterface
{
    public static function getUrl(): string
    {
        return 'https://www.20minutes.fr/monde/ukraine/';
    }

    public static function getLocale(): string
    {
        return 'fr';
    }

    public static function getCountry(): string
    {
        return 'FRA';
    }

    public static function getCustomCss(): string|null
    {
        return <<<'CSS'
            iframe {
                display: none!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return '20_minutes_%s';
    }
}
