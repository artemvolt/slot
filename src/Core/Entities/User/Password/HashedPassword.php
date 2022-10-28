<?php

namespace Slotegrator\Core\Entities\User\Password;

use Slotegrator\Core\Components\Hasher;
use Slotegrator\Core\Entities\User\Password;

/**
 * class HashedPassword
 */
class HashedPassword implements Password
{
    private Password $password;
    private Hasher $hasher;

    public function __construct(Password $password, Hasher $hasher) {
        $this->password = $password;
        $this->hasher = $hasher;
    }

    public function value(): string
    {
        return $this->hasher->hash($this->password->value());
    }
}