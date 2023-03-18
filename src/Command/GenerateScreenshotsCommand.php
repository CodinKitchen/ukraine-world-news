<?php

namespace App\Command;

use App\Media\MediaInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:generate-screenshots',
    description: 'Generate media websites screenshots',
)]
class GenerateScreenshotsCommand extends Command
{
    private const TARGET_PATH = 'public/captures/';

    private const PAGERES_BIN = 'node_modules/.bin/pageres';

    /**
     * @param iterable<MediaInterface> $medias
     */
    public function __construct(
        private array $supportedLocales,
        #[TaggedIterator('app.media')] private iterable $medias
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->medias as $media) {
            $process = new Process([self::PAGERES_BIN, $media->getUrl(), '390x844', '--css=' . $media->getCustomCss(), '--crop', '--overwrite', '--filename=' . self::TARGET_PATH . \sprintf($media->getFilename(), $media->getLocale())]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            foreach ($this->supportedLocales as $locale) {
                if ($locale === $media->getLocale()) {
                    continue;
                }
                $process = new Process([self::PAGERES_BIN, 'https://translate.google.com/translate?sl=' . $media->getLocale() . '&tl=' . $locale . '&u=' . $media->getUrl(), '390x844', '--css=' . $media->getCustomCss(), '--crop', '--overwrite', '--filename=' . self::TARGET_PATH . \sprintf($media->getFilename(), $locale)]);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
            }
        }

        return Command::SUCCESS;
    }
}
