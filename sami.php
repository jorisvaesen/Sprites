<?php

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir = sprintf('%s/src', __DIR__))
;

$versions = GitVersionCollection::create($dir)
    ->add('master', 'master branch')
;

return new Sami($iterator, array(
    'versions' => $versions,
    'title' => 'Fermio Sprites API',
    'build_dir' => sprintf('%s/api', __DIR__),
    'cache_dir' => sprintf('%s/cache', __DIR__),
));
