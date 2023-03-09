<?php

namespace App\Media;

class LeFigaro implements MediaInterface
{
    public static function getUrl(): string
    {
        return 'https://www.lefigaro.fr/tag/ukraine';
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
            #appconsent, .fig-consent-banner, .fig-top, iframe {
                display: none!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'le_figaro_%s';
    }
}
