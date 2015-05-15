<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->notName('README.md')
    ->notName('composer.*')
    ->exclude('vendor')
    ->exclude('.scrutinizer.yml')
    ->exclude('.travis.yml')
    ->exclude('.php_cs')
    ->exclude('tests')
    ->exclude('public')
    ->in(__DIR__);

return Symfony\CS\Config\Config::create()
    // use default PSR-2_LEVEL:
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->finder($finder);
