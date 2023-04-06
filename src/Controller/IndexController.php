<?php

namespace App\Controller;

use App\Media\MediaInterface;
use GeoIp2\Database\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Locales;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private const COUNTRIES_DEFAULT_LOCALE = [
        'FR' => 'fr',
        'EN' => 'en',
        'RU' => 'ru',
        'UK' => 'en',
        'UA' => 'uk',
    ];

    #[Route('/', name: 'index')]
    public function index(Request $request, Reader $reader): Response
    {
        try {
            $country = $reader->country($request->getClientIp());
            $locale = self::COUNTRIES_DEFAULT_LOCALE[$country->country->isoCode] ?? 'en';
        } catch (\Exception $e) {
            $locale = 'en';
        }

        return $this->redirectToRoute('home', ['_locale' => $locale]);
    }
}
