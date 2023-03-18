<?php

namespace App\Media\FR;

use App\Media\MediaInterface;

class LeMonde implements MediaInterface
{
    public function getName(): string
    {
        return 'Le Monde';
    }

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
        return 'FR';
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
