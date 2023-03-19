<?php

namespace App\Media\GB;

use App\Media\MediaInterface;

class TheGuardian implements MediaInterface
{
    public function getName(): string
    {
        return 'The Guardian';
    }

    public static function getUrl(): string
    {
        return 'https://www.theguardian.com/world/series/ukraine-live';
    }

    public static function getLocale(): string
    {
        return 'en';
    }

    public static function getCountry(): string
    {
        return 'GB';
    }

    public static function getCustomCss(): string|null
    {
        return <<<'CSS'
            .top-banner-ad-container, .ad-slot-container, iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'the_guardian';
    }
}
