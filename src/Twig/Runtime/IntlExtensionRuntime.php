<?php

namespace App\Twig\Runtime;

use Symfony\Component\Intl\Locales;
use Twig\Extension\RuntimeExtensionInterface;

class IntlExtensionRuntime implements RuntimeExtensionInterface
{
    public function getLocaleName(string $locale, string $displayLocale = null)
    {
        return Locales::getName($locale, $displayLocale);
    }
}
