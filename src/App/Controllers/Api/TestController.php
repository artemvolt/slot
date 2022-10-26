<?php

namespace Slotegrator\App\Controllers\Api;

use Slotegrator\App\Components\Controller;
use Symfony\Component\Console\Helper\Dumper;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

/**
 * class TestController
 */
class TestController
{
    private Environment $render;

    public function __construct(Environment $render)
    {
        $this->render = $render;
    }

    public function index(Request $request, $year)
    {
        return new JsonResponse(['hello' => 1]);
    }
}