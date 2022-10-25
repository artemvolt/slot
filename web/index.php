<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once __DIR__.'/../vendor/autoload.php';

use Slotegrator\App\Components\RequestHandler;
use Slotegrator\Core\Events\ResponseEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

function render_template(Request $request)
{

    return new Response('Render');
}

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/App/Config/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher->addListener('response', function (ResponseEvent $event) {
    $response = $event->getResponse();

    if ($response->isRedirection()
        || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
        || 'html' !== $event->getRequest()->getRequestFormat()
    ) {
        return;
    }

    $response->setContent($response->getContent().'GA CODE');
});
$errorHandler = function (Symfony\Component\ErrorHandler\Exception\FlattenException $exception) {
    $msg = 'Something went wrong! ('.$exception->getMessage().')';
    return new Response($msg, $exception->getStatusCode());
};
$dispatcher->addSubscriber(new HttpKernel\EventListener\ErrorListener($errorHandler));
$listener = new HttpKernel\EventListener\ErrorListener(
    \Slotegrator\App\Components\ErrorController::class . '::exception'
);
$dispatcher->addSubscriber($listener);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new RequestHandler($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();