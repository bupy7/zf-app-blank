<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$finder = Finder::create()
    ->in(__DIR__ . '/bin')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/env')
    ->in(__DIR__ . '/module')
    ->in(__DIR__ . '/public');
return Config::create()->setRules([
    '@PSR2' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
])
    ->setFinder($finder);
