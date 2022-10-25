<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$containerBuilder = new ContainerBuilder();
$containerBuilder->register('render', Environment::class)
    ->setArguments([
        new FilesystemLoader(__DIR__ . '/../Views'),
        [
            'cache' => __DIR__ . '/../Runtime/compilation_cache',
        ]
    ]);
return $containerBuilder;