<?php

namespace Slotegrator\Core\UseCases\Auth;

use Slotegrator\Core\UseCases\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * class LoginRequest
 */
final class LoginRequest extends Request
{
    public string $login;
    public string $pass;

    public function validate():ConstraintViolationListInterface {
        $validatedLogin = $this->validator->validate($this->login, [
            new NotBlank()
        ]);
        if (count($validatedLogin) > 0) {
            return $validatedLogin;
        }
        return $this->validator->validate($this->pass, [
            new NotBlank()
        ]);
    }
}