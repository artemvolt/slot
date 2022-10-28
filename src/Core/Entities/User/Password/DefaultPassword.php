<?php

namespace Slotegrator\Core\Entities\User\Password;

use Slotegrator\Core\Entities\User\Password;

/**
 * class DefaultPassword
 */
class DefaultPassword implements Password
{
    private string $password;

    public function __construct(string $password) {
        $this->password = $password;
    }

    public function value(): string
    {
        return $this->password;
    }
}