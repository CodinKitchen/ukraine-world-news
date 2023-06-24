<?php

namespace App\Service;

use App\Media\MediaInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class ScreenshotGenerator
{
    private const TARGET_PATH = 'public/captures/%s/%s/';

    private const PAGERES_BIN = '%s/node_modules/.bin/pageres';

    /**
     * @param iterable<MediaInterface> $medias
     */
    public function __construct(
        private array $supportedLocales,
        private string $projectDir,
        #[TaggedIterator('app.media')] private iterable $medias,
        private LoggerInterface $logger,
    ) {
    }

    public function generateScreenshots(string|null $targetPath): int
    {
        $filesystem = new Filesystem();
        /** @var Process[] $processes */
        $processes = [];
        foreach ($this->medias as $media) {
            foreach ($this->supportedLocales as $locale) {
                $filesystem->mkdir(\sprintf('%s/%s', $this->projectDir, \sprintf(self::TARGET_PATH, $media->getCountry(), $locale)));
                $process = new Process([\sprintf(self::PAGERES_BIN, $this->projectDir), \sprintf('https://translate.google.com/translate?sl=%s&tl=%s&u=%s', $media->getLocale() === $locale ? 'ja' : $media->getLocale(), $locale, $media->getUrl()), '390x1266', '--scale=2', '--css=' . $media->getCustomCss(), '--crop', '--overwrite', '--filename=' . \sprintf($targetPath ?? self::TARGET_PATH, $media->getCountry(), $locale) . $media->getFilename()]);
                $process->start();
                $this->logger->info(\sprintf('Generating %s screenshot for locale %s', $media->getName(), $locale));
                $processes[] = $process;
            }

            while (\count($processes) > 0) {
                $this->logger->info('Checking processes...');
                foreach ($processes as $index => $process) {
                    if (!$process->isRunning()) {
                        if (!$process->isSuccessful()) {
                            $this->logger->warning($process->getErrorOutput());
                        }
                        unset($processes[$index]);
                    }
                }
                sleep(1);
            }
        }


        return Command::SUCCESS;
    }
}
