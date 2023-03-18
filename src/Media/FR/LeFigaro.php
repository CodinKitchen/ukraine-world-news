<?php

namespace App\Media\FR;

use App\Media\MediaInterface;

class LeFigaro implements MediaInterface
{
    public function getName(): string
    {
        return 'Le Figaro';
    }

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
        return 'FR';
    }

    public static function getCustomCss(): string|null
    {
        return <<<'CSS'
            #appconsent, .fig-consent-banner, .fig-top, iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'le_figaro_%s';
    }
}
