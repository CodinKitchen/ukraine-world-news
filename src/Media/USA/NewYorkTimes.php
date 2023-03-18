<?php

namespace App\Media\USA;

use App\Media\MediaInterface;

class NewYorkTimes implements MediaInterface
{
    public static function getUrl(): string
    {
        return 'https://www.nytimes.com/topic/destination/ukraine';
    }

    public static function getLocale(): string
    {
        return 'en';
    }

    public static function getCountry(): string
    {
        return 'USA';
    }

    public static function getCustomCss(): string|null
    {
        return <<<'CSS'
            .gdpr, iframe {
                display: none!important
            }
            body {
                margin-top: 0px!important
            }
        CSS;
    }

    public static function getFilename(): string
    {
        return 'new_york_times_%s';
    }
}
