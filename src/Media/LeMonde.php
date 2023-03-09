<?php

namespace App\Media;

class LeMonde implements MediaInterface
{
    public static function getUrl(): string
    {
        return 'https://www.lemonde.fr/ukraine';
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
            #banniere_haute, .gdpr-lmd-wall, iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'le_monde_%s';
    }
}
