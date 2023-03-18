<?php

namespace App\Media\FRA;

use App\Media\MediaInterface;

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
            #didomi-host, .ad, iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return '20_minutes_%s';
    }
}
