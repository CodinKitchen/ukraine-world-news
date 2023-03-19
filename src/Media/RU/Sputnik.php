<?php

namespace App\Media\RU;

use App\Media\MediaInterface;

class Sputnik implements MediaInterface
{
    public function getName(): string
    {
        return 'Sputnik';
    }

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
        return 'RU';
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
        return 'sputnik';
    }
}
