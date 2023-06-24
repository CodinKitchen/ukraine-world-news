<?php

namespace App\Command;

use App\Service\ScreenshotGenerator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generate-screenshots',
    description: 'Generate media websites screenshots',
)]
class GenerateScreenshotsCommand extends Command
{
    public function __construct(
        private ScreenshotGenerator $screenshotGenerator
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->screenshotGenerator->generateScreenshots();

        return Command::SUCCESS;
    }
}
