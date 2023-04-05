<?php

namespace App\Media\UA;

use App\Media\MediaInterface;

class NovoeVremia implements MediaInterface
{
    public function getName(): string
    {
        return 'Novoe Vremia';
    }

    public static function getUrl(): string
    {
        return 'https://nv.ua/ukr/tags/viyna-rosiji-proti-ukrajini.html';
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
            iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'novoe_vremia';
    }
}