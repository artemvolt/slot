<?php

namespace Slotegrator\Core\Components;

/**
 * class Hasher
 */
class Hasher
{
    private string $alg;
    private string $salt;

    public function __construct(string $alg, string $salt)
    {
        $this->alg = $alg;
        $this->salt = $salt;
    }

    public function hash(string $value):string {
        return $value;
    }
}