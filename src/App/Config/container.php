<?php

use Slotegrator\App\Components\ControllerResolver;
use Slotegrator\App\Components\ErrorController;
use Slotegrator\App\Components\RequestHandler;
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$containerBuilder = new DependencyInjection\ContainerBuilder();
$containerBuilder->register('context', Routing\RequestContext::class);
$containerBuilder->register('matcher', Routing\Matcher\UrlMatcher::class)
    ->setArguments([
        include __DIR__.'/../Config/routes.php',
        new Reference('context')
    ])
;
$containerBuilder->register('request_stack', HttpFoundation\RequestStack::class);
$containerBuilder->register('render', Environment::class)
    ->setArguments([
        new FilesystemLoader(__DIR__ . '/../Views'),
        [
            'cache' => __DIR__ . '/../Runtime/compilation_cache',
        ]
    ]);

$containerBuilder->register('controller_resolver', ControllerResolver::class)->setArguments([
    null,
    $containerBuilder
]);
$containerBuilder->register('argument_resolver', HttpKernel\Controller\ArgumentResolver::class);

$containerBuilder->register('listener.router', HttpKernel\EventListener\RouterListener::class)
    ->setArguments([new Reference('matcher'), new Reference('request_stack')])
;
$containerBuilder->register('listener.response', HttpKernel\EventListener\ResponseListener::class)
    ->setArguments(['UTF-8'])
;
$containerBuilder->register('listener.exception', HttpKernel\EventListener\ErrorListener::class)
    ->setArguments([ErrorController::class . '::exception'])
;
$containerBuilder->register('dispatcher', EventDispatcher\EventDispatcher::class)
    ->addMethodCall('addSubscriber', [new Reference('listener.router')])
    ->addMethodCall('addSubscriber', [new Reference('listener.response')])
    ->addMethodCall('addSubscriber', [new Reference('listener.exception')])
;
$containerBuilder->register('framework', RequestHandler::class)
    ->setArguments([
        new Reference('dispatcher'),
        new Reference('controller_resolver'),
        new Reference('request_stack'),
        new Reference('argument_resolver'),
    ])
;
return $containerBuilder;