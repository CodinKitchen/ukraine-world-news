<?php

namespace App\Controller;

use App\Service\ScreenshotGenerator;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/commands', name: 'app_commands')]
#[IsGranted('ROLE_ADMIN')]
class CommandsController extends AbstractController
{
    #[Route('/generate-screenshots', name: 'command_generate_screenshot')]
    public function generateScreenshots(ScreenshotGenerator $screenshotGenerator): Response
    {
        $screenshotGenerator->generateScreenshots('captures/%s/%s/');

        return $this->json([
            'status' => 'success',
        ]);
    }

    #[Route('/update-geoip', name: 'command_update_geoip')]
    public function updateGeoIP(KernelInterface $kernel): Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'geoip2:update',
        ]);

        $output = new NullOutput();
        $application->run($input, $output);

        return $this->json([
            'status' => 'success',
        ]);
    }
}
