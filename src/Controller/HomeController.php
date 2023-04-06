<?php

namespace App\Controller;

use App\Media\MediaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param iterable<MediaInterface> $medias
     */
    public function __construct(#[TaggedIterator('app.media')] private iterable $medias)
    {
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $mediasByCountry = [];

        foreach ($this->medias as $media) {
            if (!\array_key_exists($media->getCountry(), $mediasByCountry)) {
                $mediasByCountry[$media->getCountry()] = [];
            }
            $mediasByCountry[$media->getCountry()][] = $media;
        }

        // Randomize array while preserving keys
        \uksort($mediasByCountry, fn ($a, $b) => \random_int(-1, 1));

        return $this->render('home/index.html.twig', [
            'mediasByCountry' => $mediasByCountry,
        ]);
    }
}
