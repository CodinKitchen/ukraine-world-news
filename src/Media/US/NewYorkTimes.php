<?php

namespace App\Media\US;

use App\Media\MediaInterface;

class NewYorkTimes implements MediaInterface
{
    public function getName(): string
    {
        return 'The New York Times';
    }

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
        return 'US';
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
        return 'new_york_times';
    }
}
