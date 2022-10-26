<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Slotegrator\App\Components\RequestHandler;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/App/Config/routes.php';
$container = include __DIR__.'/../src/App/Config/container.php';

$container->get('framework')->handle($request)->send();