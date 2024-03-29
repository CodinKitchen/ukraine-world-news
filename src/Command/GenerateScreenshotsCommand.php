<?php

namespace App\Command;

use App\Media\MediaInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:generate-screenshots',
    description: 'Generate media websites screenshots',
)]
class GenerateScreenshotsCommand extends Command
{
    private const TARGET_PATH = 'public/captures/%s/%s/';

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
        $filesystem = new Filesystem();
        /** @var Process[] $processes */
        $processes = [];
        foreach ($this->medias as $media) {
            foreach ($this->supportedLocales as $locale) {
                $filesystem->mkdir(\sprintf(self::TARGET_PATH, $media->getCountry(), $locale));
                $process = new Process([self::PAGERES_BIN, \sprintf('https://translate.google.com/translate?sl=%s&tl=%s&u=%s', $media->getLocale() === $locale ? 'ja' : $media->getLocale(), $locale, $media->getUrl()), '390x1266', '--scale=2', '--css=' . $media->getCustomCss(), '--crop', '--overwrite', '--filename=' . \sprintf(self::TARGET_PATH, $media->getCountry(), $locale) . $media->getFilename()]);
                $process->start();
                $output->writeln(\sprintf('Generating %s screenshot for locale %s', $media->getName(), $locale));
                $processes[] = $process;
            }

            while (\count($processes) > 0) {
                $output->writeln('Checking processes...');
                foreach ($processes as $index => $process) {
                    if (!$process->isRunning()) {
                        if (!$process->isSuccessful()) {
                            $output->writeln($process->getErrorOutput());
                        }
                        unset($processes[$index]);
                    }
                    try {
                        $process->checkTimeout();
                    } catch (ProcessTimedOutException $exception) {
                        $output->writeln(\sprintf('%s %s', $process->getCommandLine(), $exception->getMessage()));
                        $process->stop(0);
                        unset($processes[$index]);
                    }
                }
                sleep(1);
            }
        }


        return Command::SUCCESS;
    }
}
