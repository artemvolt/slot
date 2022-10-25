<?php

use Slotegrator\App\Controllers\Api\TestController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('leap_year', new Route('/api/bank/{year}', [
    'year' => null,
    '_controller' => TestController::class . '::index',
]));

return $routes;