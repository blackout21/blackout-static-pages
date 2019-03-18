#!/usr/bin/env php
<?php

use Symfony\Component\Finder\Finder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// paths
$templatesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src';
$translationsPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'translations';
$targetPath = __DIR__ . DIRECTORY_SEPARATOR . '..';

// tools
$loader = new FilesystemLoader($templatesPath);
$renderer = new Environment($loader);
$finder = Finder::create();

foreach ($finder->files()->in($translationsPath)->name('*.json') as $file) {
    /** @var $file SplFileInfo */
    $language = $file->getBasename('.json');
    $filename = sprintf('blackout_%s.html', $language);
    $translationFile = file_get_contents($file->getPathname());
    $translationData = json_decode($translationFile, true);
    $translationData['language'] = $language;

    if (json_last_error() !== JSON_ERROR_NONE) {
        printf('ERROR: %s in language %s' . PHP_EOL, json_last_error_msg(), $language);
        return 1;
    }

    printf('Generating blackout page "%s"…' . PHP_EOL, $filename);
    $blackoutPage = $renderer->render('blackout.html.twig', $translationData);

    file_put_contents($filename, $blackoutPage);
}

return 0;
