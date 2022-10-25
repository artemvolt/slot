<?php

namespace Slotegrator\App\Controllers\Api;

use Slotegrator\App\Components\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * class TestController
 */
class TestController
{
    public function index(Request $request, $year)
    {
        return new JsonResponse(['hello' => 1]);
    }
}