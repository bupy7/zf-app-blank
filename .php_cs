<?php

use Symfony\CS\Config;
use Symfony\CS\FixerInterface;
use Symfony\CS\Finder;

$finder = Finder::create()
    ->in(__DIR__ . '/bin')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/env')
    ->in(__DIR__ . '/module')
    ->in(__DIR__ . '/public');
return Config::create()
    ->level(FixerInterface::PSR2_LEVEL)
    ->finder($finder);