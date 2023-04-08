<?php

namespace App\Asset\VersionStrategy;

use Symfony\Component\Asset\VersionStrategy\VersionStrategyInterface;

class FileTimestampVersionStrategy implements VersionStrategyInterface
{
    public function __construct(private string $rootDir)
    {
    }

    public function getVersion(string $path): string
    {
        $file = $this->rootDir . '/' . $path;
        if (!file_exists($file)) {
            return '';
        }

        return (string)filemtime($file) ?: '0';
    }

    public function applyVersion(string $path): string
    {
        return sprintf('%s?v=%s', $path, $this->getVersion($path));
    }
}
