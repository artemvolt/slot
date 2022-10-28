<?php

namespace Slotegrator\App\Controllers\Api;

use Slotegrator\Core\UseCases\Auth\LoginRequest;
use Slotegrator\Core\UseCases\AuthUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

/**
 * class TestController
 */
class AuthController
{
    private AuthUseCase $case;

    public function __construct(AuthUseCase $case)
    {
        $this->case = $case;
    }

    public function auth(Request $request):JsonResponse
    {
        $requestCase = new LoginRequest(Validation::createValidator());
        $requestCase->login = $request->request->get('login');
        $requestCase->pass = $request->request->get('pass');
        $requestCase = $this->case->byLogin($requestCase);
        if ($requestCase->isValidateErrors()) {
            return new JsonResponse([
                'errors' => $requestCase->getValidationErrors()
            ], 421);
        }
        if ( ! $requestCase->isSuccess()) {
            return new JsonResponse([
                'error' => $requestCase->getErrorText()
            ], 405);
        }

        return new JsonResponse(['data' => []]);
    }
}