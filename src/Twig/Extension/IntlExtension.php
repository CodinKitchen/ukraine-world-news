<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\IntlExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class IntlExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('locale_name', [IntlExtensionRuntime::class, 'getLocaleName']),
        ];
    }
}
