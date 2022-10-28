<?php

namespace Slotegrator\Core\UseCases\RandomPrize;

use Slotegrator\Core\Entities\User;
use Slotegrator\Core\UseCases\Request as IRequest;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * class Request
 */
class Request extends IRequest
{
    public User $user;

    public function validate(): ConstraintViolationListInterface
    {

    }
}