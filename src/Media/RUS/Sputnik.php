<?php

namespace App\Media\RUS;

use App\Media\MediaInterface;

class Sputnik implements MediaInterface
{
    public static function getUrl(): string
    {
        return 'https://sputniknews.com/russian-special-military-op-in-ukraine/';
    }

    public static function getLocale(): string
    {
        return 'en';
    }

    public static function getCountry(): string
    {
        return 'RUS';
    }

    public static function getCustomCss(): string|null
    {
        return <<<'CSS'
            #iubenda-cs-banner, iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'sputnik_%s';
    }
}
