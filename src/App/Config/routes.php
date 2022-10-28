<?php

use Slotegrator\App\Controllers\Api\AuthController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('leap_year', new Route('/api/bank/{year}', [
    'year' => null,
    '_controller' => AuthController::class . '::index',
]));

return $routes;