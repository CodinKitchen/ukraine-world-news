<?php

namespace App\Media\UA;

use App\Media\MediaInterface;

class Korrespondent implements MediaInterface
{
    public function getName(): string
    {
        return 'Korrespondent';
    }

    public static function getUrl(): string
    {
        return 'https://ua.korrespondent.net/special/2111-viina-rosii-z-ukrainoui';
    }

    public static function getLocale(): string
    {
        return 'uk';
    }

    public static function getCountry(): string
    {
        return 'UA';
    }

    public static function getCustomCss(): string|null
    {
        return <<<'CSS'
            .unit-top-dark-banner, .mgbox, iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'korrespondent';
    }
}
