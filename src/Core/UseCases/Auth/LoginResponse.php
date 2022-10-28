<?php

namespace Slotegrator\Core\UseCases\Auth;

use Slotegrator\Core\UseCases\Response;
use Slotegrator\Core\Entities\User;

/**
 * class LoginResponse
 */
class LoginResponse extends Response
{
    public User $user;
}